<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\Category;
use App\Models\Make;
use App\Models\CarModel;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
     {
         // $this->middleware('auth');
        
         View::share('socialLinks', SocialLink::all());
         View::share('categories', Category::all());
     }
 


    public function index()
    {
        $parts = Part::with(['make', 'carModel', 'year', 'category'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.parts.parts', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = Make::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $parts = Part::with(['make', 'carModel', 'year', 'category'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.parts.create', compact('makes', 'categories', 'parts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'quality' => 'required|in:new,used',
            'stock_level' => 'required|integer|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'make_id' => 'required|exists:makes,id',
            'car_model_id' => 'required|exists:car_models,id',
            'year_id' => 'required|exists:years,id',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Handle image uploads
        $imagePaths = [];
        foreach(['main_image', 'image_1', 'image_2', 'image_3'] as $field) {
            if($request->hasFile($field)) {
                $imagePaths[$field] = $request->file($field)->store('parts', 'public');
            }
        }
    
        $part = Part::create(array_merge(
            $validated,
            $imagePaths
        ));
    
        return redirect()->route('admin.parts.index')
            ->with('success', 'Part created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        $makes = \App\Models\Make::orderBy('name')->get();
        $categories = \App\Models\Category::orderBy('name')->get();
        // Fix: Filter car models by make_id, not id
        $models = \App\Models\CarModel::where('make_id', $part->make_id)->orderBy('name')->get();
        // Fix: Since years aren’t tied to a car model in the migration, load all years
        $years = \App\Models\Year::orderBy('year')->get();
    
        return view('admin.parts.edit', compact('part', 'makes', 'categories', 'models', 'years'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'quality' => 'required|in:new,used',
            'stock_level' => 'required|integer',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $part->name = $request->name;
        $part->description = $request->description;
        $part->price = $request->price;
        $part->note = $request->note;
        $part->quality = $request->quality;
        $part->stock_level = $request->stock_level;

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('images', 'public');
            $part->main_image = $mainImagePath;
        }

        if ($request->hasFile('image_1')) {
            $image1Path = $request->file('image_1')->store('images', 'public');
            $part->image_1 = $image1Path;
        }

        if ($request->hasFile('image_2')) {
            $image2Path = $request->file('image_2')->store('images', 'public');
            $part->image_2 = $image2Path;
        }

        if ($request->hasFile('image_3')) {
            $image3Path = $request->file('image_3')->store('images', 'public');
            $part->image_3 = $image3Path;
        }

        $part->save();

        return redirect()->route('admin.parts.index')->with('success', 'Part updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('admin.parts.index')->with('success', 'Part deleted successfully.');
    }

    
}
