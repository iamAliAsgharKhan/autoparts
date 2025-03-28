<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\Category; // Assuming layout needs categories

class YearController extends Controller
{
    /**
     * Constructor to share common data and apply middleware.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Protect all admin actions

        // Share data needed for the admin layout/partials
        View::share('socialLinks', SocialLink::all());
        View::share('categories', Category::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Order by year, descending is common for years
        $years = Year::orderBy('year', 'desc')->paginate(20);
        return view('admin.years.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentYear = date('Y');
        $validated = $request->validate([
            // Validate as a 4-digit integer, unique, and within a reasonable range
            'year' => "required|integer|digits:4|unique:years,year|min:1900|max:" . ($currentYear + 5),
        ], [
            'year.digits' => 'The year must be exactly 4 digits.',
            'year.min' => 'The year must be 1900 or later.',
            'year.max' => 'The year cannot be too far in the future.',
        ]);

        Year::create($validated);

        return redirect()->route('admin.years.index')
                         ->with('success', 'Year created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year)
    {
        return view('admin.years.show', compact('year'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year)
    {
        return view('admin.years.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year)
    {
        $currentYear = date('Y');
        $validated = $request->validate([
            // Adjust unique rule to ignore the current year's ID
            'year' => "required|integer|digits:4|unique:years,year,{$year->id}|min:1900|max:" . ($currentYear + 5),
        ], [
            'year.digits' => 'The year must be exactly 4 digits.',
            'year.min' => 'The year must be 1900 or later.',
            'year.max' => 'The year cannot be too far in the future.',
        ]);

        $year->update($validated);

        return redirect()->route('admin.years.index')
                         ->with('success', 'Year updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year)
    {
        // **Important Check:** Prevent deletion if related records exist (e.g., Parts)
        if ($year->parts()->exists()) {
             return redirect()->route('admin.years.index')
                              ->with('error', 'Cannot delete year: It is associated with existing Parts.');
        }

        try {
            $year->delete();
            return redirect()->route('admin.years.index')
                             ->with('success', 'Year deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback error handling
            return redirect()->route('admin.years.index')
                             ->with('error', 'Could not delete year. It might still be referenced elsewhere.');
        }
    }
}