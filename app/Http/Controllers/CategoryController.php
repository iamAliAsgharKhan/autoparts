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
    public function show($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch parts belonging to the category
        $products = $category->parts()->paginate(10);

        // Pass the data to the view
        return view('products', compact('category', 'products'));
    }
}