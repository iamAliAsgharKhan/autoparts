<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\Category;
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
        $parts = Part::all();
        return view('parts.index', compact('parts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
            'quality' => 'required|in:new,used',
            'stock_level' => 'required|integer',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $part = new Part();
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

        return redirect()->route('parts.index')->with('success', 'Part created successfully.');
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
        return view('parts.edit', compact('part'));
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

        return redirect()->route('parts.index')->with('success', 'Part updated successfully.');
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
        return redirect()->route('parts.index')->with('success', 'Part deleted successfully.');
    }
}
