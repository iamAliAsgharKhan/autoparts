<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;       // Import DB for transactions
use Illuminate\Support\Facades\Storage; // Import Storage
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\Category;

class ProjectController extends Controller
{
    /**
     * Constructor: Middleware and shared view data.
     */
    public function __construct()
    {
        $this->middleware('auth');
        // Share data needed for the admin layout/partials
        View::share('socialLinksGlobal', SocialLink::all());
        View::share('categories', Category::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'description' => 'nullable|string',
            'before_images' => 'nullable|array', // Expect an array of files
            'before_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate each file
            'after_images' => 'nullable|array',
            'after_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        DB::beginTransaction(); // Start transaction for safety

        try {
            // 1. Create Project
            $project = Project::create([
                'headline' => $validated['headline'],
                'description' => $validated['description'],
            ]);

            // 2. Handle 'Before' Images
            if ($request->hasFile('before_images')) {
                foreach ($request->file('before_images') as $index => $file) {
                    // Store the image (e.g., in storage/app/public/projects/before)
                    $path = $file->store('projects/before', 'public');

                    // Create ProjectImage record
                    $project->images()->create([
                        'image_path' => $path,
                        'type' => 'before',
                        'order' => $index + 1, // Simple order based on upload sequence
                    ]);
                }
            }

            // 3. Handle 'After' Images
            if ($request->hasFile('after_images')) {
                foreach ($request->file('after_images') as $index => $file) {
                    $path = $file->store('projects/after', 'public');
                    $project->images()->create([
                        'image_path' => $path,
                        'type' => 'after',
                        'order' => $index + 1,
                    ]);
                }
            }

            DB::commit(); // Everything okay, commit changes

            return redirect()->route('admin.projects.index')
                             ->with('success', 'Project created successfully.');

        } catch (\Exception $e) {
            DB::rollBack(); // Something went wrong, rollback

            // Optional: Log the error
            // Log::error('Project creation failed: ' . $e->getMessage());

            return redirect()->back()
                             ->with('error', 'Failed to create project. Please try again. Error: ' . $e->getMessage())
                             ->withInput(); // Keep old input
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Eager load images for display
        $project->load(['beforeImages', 'afterImages']);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $project->load(['beforeImages', 'afterImages']); // Load existing images
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'description' => 'nullable|string',
            'new_before_images' => 'nullable|array', // Files for new 'before' images
            'new_before_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'new_after_images' => 'nullable|array', // Files for new 'after' images
            'new_after_images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'delete_images' => 'nullable|array', // Array of image IDs to delete
            'delete_images.*' => 'integer|exists:project_images,id', // Validate IDs exist
        ]);

        DB::beginTransaction();

        try {
            // 1. Update Project Details
            $project->update([
                'headline' => $validated['headline'],
                'description' => $validated['description'],
            ]);

            // 2. Delete Marked Images
            if (!empty($validated['delete_images'])) {
                foreach ($validated['delete_images'] as $imageId) {
                    $image = ProjectImage::find($imageId);
                    // **Security Check:** Ensure the image belongs to THIS project
                    if ($image && $image->project_id === $project->id) {
                        Storage::disk('public')->delete($image->image_path); // Delete file from storage
                        $image->delete(); // Delete record from DB
                    }
                }
            }

            // 3. Add New 'Before' Images
            if ($request->hasFile('new_before_images')) {
                 // Find the current max order for 'before' images for this project
                 $maxOrder = $project->beforeImages()->max('order') ?? 0;
                 foreach ($request->file('new_before_images') as $index => $file) {
                    $path = $file->store('projects/before', 'public');
                    $project->images()->create([
                        'image_path' => $path,
                        'type' => 'before',
                        'order' => $maxOrder + $index + 1, // Append to existing order
                    ]);
                }
            }

            // 4. Add New 'After' Images
             if ($request->hasFile('new_after_images')) {
                $maxOrder = $project->afterImages()->max('order') ?? 0;
                 foreach ($request->file('new_after_images') as $index => $file) {
                    $path = $file->store('projects/after', 'public');
                    $project->images()->create([
                        'image_path' => $path,
                        'type' => 'after',
                        'order' => $maxOrder + $index + 1,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.projects.index')
                             ->with('success', 'Project updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                             ->with('error', 'Failed to update project. Error: ' . $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        DB::beginTransaction();

        try {
            // 1. Delete Associated Image Files from Storage
            foreach ($project->images as $image) { // Use the general 'images' relationship
                Storage::disk('public')->delete($image->image_path);
            }

            // 2. Delete Project (Cascade should delete image records due to migration setup)
            $project->delete();

            DB::commit();

             return redirect()->route('admin.projects.index')
                             ->with('success', 'Project deleted successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
             return redirect()->route('admin.projects.index')
                              ->with('error', 'Failed to delete project. Error: ' . $e->getMessage());
        }
    }
}