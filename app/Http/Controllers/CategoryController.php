<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Make;
use App\Models\Year;
use App\Models\CarModel;
use App\Models\SocialLink;
use App\Models\Category;
class CategoryController extends Controller
{


    public function __construct()
    {
        // $this->middleware('auth');
       
        View::share('socialLinks', SocialLink::all());
        View::share('categories', Category::all());
    }
    public function publicshow($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch parts belonging to the category
        $products = $category->parts()->paginate(10);

        // Pass the data to the view
        return view('products', compact('category', 'products'));
    }

    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Show the form for creating a new category.
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|unique:categories,name|max:255',
            'description' => 'nullable',
            'slug'        => 'required|unique:categories,slug|max:255',
            'image'       => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Display the specified category.
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    // Show the form for editing the specified category.
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified category in storage.
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable',
            'slug'        => 'required|max:255|unique:categories,slug,' . $category->id,
            'image'       => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Optionally delete old image:
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Remove the specified category from storage.
    public function destroy(Category $category)
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}