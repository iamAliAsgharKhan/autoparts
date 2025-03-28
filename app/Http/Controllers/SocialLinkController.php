<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Category; // Assuming layout needs categories

class SocialLinkController extends Controller
{
    /**
     * Constructor to share common data and apply middleware.
     */
    public function __construct()
    {
        $this->middleware('auth'); // Protect all admin actions

        // Share data needed for the admin layout/partials
        // Avoid sharing SocialLink::all() here if this controller manages it,
        // to prevent potential issues during create/update/delete within the same request cycle.
        // Let the layout fetch them if needed, or pass specifically where required.
        // However, if other parts of the admin ALWAYS need them, keep it, but be mindful.
        // For now, let's assume the layout might use them independently.
        View::share('socialLinksGlobal', SocialLink::all()); // Use a different name if sharing
        View::share('categories', Category::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::orderBy('platform_name')->get(); // Get all, usually not many
        return view('admin.social_links.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch icons from config
        $icons = config('icons.social', []); // Default to empty array if config/key missing
        return view('admin.social_links.create', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform_name' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:100', // Validate icon class input
        ]);

        SocialLink::create($validated);

        return redirect()->route('admin.social_links.index')
                         ->with('success', 'Social Link created successfully.');
    }

    /**
     * Display the specified resource. (Optional for this simple resource)
     */
    public function show(SocialLink $socialLink)
    {
         return view('admin.social_links.show', compact('socialLink'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        // Fetch icons from config
        $icons = config('icons.social', []);
        return view('admin.social_links.edit', compact('socialLink', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform_name' => 'required|string|max:100',
            'url' => 'required|url|max:255',
            'icon' => 'required|string|max:100',
        ]);

        $socialLink->update($validated);

        return redirect()->route('admin.social_links.index')
                         ->with('success', 'Social Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        try {
            $socialLink->delete();
            return redirect()->route('admin.social_links.index')
                             ->with('success', 'Social Link deleted successfully.');
        } catch (\Exception $e) {
            // Generic error handling
            return redirect()->route('admin.social_links.index')
                             ->with('error', 'Could not delete social link.');
        }
    }
}