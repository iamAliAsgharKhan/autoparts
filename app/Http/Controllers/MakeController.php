<?php

namespace App\Http\Controllers;

use App\Models\Make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View; // Import View
use App\Models\SocialLink;           // Import SocialLink
use App\Models\Category;              // Import Category (if needed by layout)

class MakeController extends Controller
{
    /**
     * Constructor to share common data with views.
     */
    public function __construct()
    {
        // Apply auth middleware to ensure only logged-in users access admin actions
        $this->middleware('auth');

        // Share data needed for the admin layout/partials
        View::share('socialLinks', SocialLink::all());
        View::share('categories', Category::all()); // Share categories if your admin sidebar uses them
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $makes = Make::orderBy('name')->paginate(15); // Paginate for potentially long lists
        return view('admin.makes.index', compact('makes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.makes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:makes,name',
        ]);

        Make::create($validated);

        return redirect()->route('admin.makes.index')
                         ->with('success', 'Make created successfully.');
    }

    /**
     * Display the specified resource.
     * Note: A dedicated show view might be overkill for just a name,
     * but included for completeness of a resource controller.
     */
    public function show(Make $make)
    {
         return view('admin.makes.show', compact('make'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Make $make)
    {
        return view('admin.makes.edit', compact('make'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Make $make)
    {
        $validated = $request->validate([
            // Ensure name is unique, but ignore the current make's ID
            'name' => 'required|string|max:255|unique:makes,name,' . $make->id,
        ]);

        $make->update($validated);

        return redirect()->route('admin.makes.index')
                         ->with('success', 'Make updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Make $make)
    {
        // Optional: Add check for related models before deleting
        // if ($make->carModels()->exists() || $make->parts()->exists()) {
        //     return redirect()->route('admin.makes.index')
        //                      ->with('error', 'Cannot delete make: It is associated with existing models or parts.');
        // }

        try {
            $make->delete();
            return redirect()->route('admin.makes.index')
                             ->with('success', 'Make deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Catch potential foreign key constraint errors if checks above are not used
            return redirect()->route('admin.makes.index')
                             ->with('error', 'Cannot delete make: It might be associated with other records.');
        }
    }
}