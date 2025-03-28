<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Make; // Import Make model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\SocialLink;
use App\Models\Category; // Assuming layout needs categories

class CarModelController extends Controller
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
        // Eager load the 'make' relationship to prevent N+1 queries
        $carModels = CarModel::with('make')
                              ->orderBy('make_id') // Optional: Group by make first
                              ->orderBy('name')
                              ->paginate(15);
        return view('admin.car_models.index', compact('carModels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $makes = Make::orderBy('name')->get(); // Get makes for dropdown
        return view('admin.car_models.create', compact('makes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:car_models,name',
            'make_id' => 'required|integer|exists:makes,id', // Validate make exists
        ]);

        CarModel::create($validated);

        return redirect()->route('admin.car_models.index')
                         ->with('success', 'Car Model created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $carModel)
    {
         // Eager load relationship if not automatically done by route-model binding
         $carModel->load('make');
         return view('admin.car_models.show', compact('carModel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarModel $carModel)
    {
        $makes = Make::orderBy('name')->get(); // Get makes for dropdown
        return view('admin.car_models.edit', compact('carModel', 'makes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarModel $carModel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:car_models,name,' . $carModel->id,
            'make_id' => 'required|integer|exists:makes,id',
        ]);

        $carModel->update($validated);

        return redirect()->route('admin.car_models.index')
                         ->with('success', 'Car Model updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $carModel)
    {


        try {
            $carModel->delete();
            return redirect()->route('admin.car_models.index')
                             ->with('success', 'Car Model deleted successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback error handling for unexpected DB constraints
            return redirect()->route('admin.car_models.index')
                             ->with('error', 'Could not delete car model. It might still be referenced elsewhere.');
        }
    }
}