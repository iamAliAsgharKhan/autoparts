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
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
       
        View::share('socialLinks', SocialLink::all());
        View::share('categories', Category::all());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $makes = Make::all();
        $years = Year::all();

        $recentProducts = Part::latest()->take(4)->get();
        return view('home', compact('makes', 'years','recentProducts'));
    }

    public function show($id){

        $product = Part::findOrFail($id);

        // Fetch related products based on the same category_id
        $relatedProducts = Part::where('category_id', $product->category_id)
                                ->where('id', '!=', $product->id) // Exclude the current product
                                ->take(4) // Limit to 4 related products
                                ->get();
        
        return view('product', compact('product', 'relatedProducts'));
    }

    public function products(){

        $products = Part::all();
        return view('products', compact('products'));
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Perform a search on the Part model
        $results = Part::where('name', 'LIKE', "%{$query}%")
                       ->orWhere('description', 'LIKE', "%{$query}%")
                       ->paginate(10); // Paginate results for better performance
        // dd($results);
        // Pass the results to the view
        return view('searchresult', compact('results', 'query'));
    }

    // Handle the filter request
    public function filter(Request $request)
    {
        // Get the filter parameters from the request
        $makeId = $request->input('make_id');
        $modelId = $request->input('car_model_id');
        $yearId = $request->input('year_id');

        // Build the query
        $query = Part::query();

        if ($makeId) {
            $query->where('make_id', $makeId);
        }

        if ($modelId) {
            $query->where('car_model_id', $modelId);
        }

        if ($yearId) {
            $query->where('year_id', $yearId);
        }

        // Paginate the results
        $results = $query->paginate(10);

        // Pass the results and filter parameters to the view
        return view('filtered-results', compact('results', 'makeId', 'modelId', 'yearId'));
    }


    public function apimodel(Request $request)
    {
        // Get the make_id from the query string
        $makeId = $request->query('make_id');

        // Validate that make_id is provided
        if (!$makeId) {
            return response()->json(['error' => 'make_id is required'], 400);
        }

        // Fetch models for the given make_id
        $models = CarModel::where('make_id', $makeId)->get(['id', 'name']);

        // Return the models as JSON
        return response()->json($models);
    }
}
