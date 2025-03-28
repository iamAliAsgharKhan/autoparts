@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Parts Listing</h6>
        <a href="{{ route('admin.parts.index') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </div>
    <div class="card-body">
        
        <form action="{{ route('admin.parts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Part Name -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Part Name</label>
                    <input type="text" name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Price -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Price (Rs)</label>
                    <input type="number" name="price" step="1" min="0"
                           class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price') }}" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Quality -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Quality</label>
                    <select name="quality" class="form-control @error('quality') is-invalid @enderror" required>
                        <option value="">-- Select Quality --</option>
                        <option value="new" {{ old('quality') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="used" {{ old('quality') == 'used' ? 'selected' : '' }}>Used</option>
                    </select>
                    @error('quality')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Stock Level -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Stock Level</label>
                    <input type="number" name="stock_level"
                           class="form-control @error('stock_level') is-invalid @enderror" 
                           value="{{ old('stock_level', 0) }}" required>
                    @error('stock_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Category -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Category</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Make -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Make</label>
                    <select name="make_id" id="make" class="form-control @error('make_id') is-invalid @enderror" required>
                        <option value="">-- Select Make --</option>
                        @foreach($makes as $make)
                            <option value="{{ $make->id }}" {{ old('make_id') == $make->id ? 'selected' : '' }}>
                                {{ $make->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('make_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Model -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Model</label>
                    <select name="car_model_id" id="model" class="form-control @error('car_model_id') is-invalid @enderror" required>
                        <option value="">-- Select Model --</option>
                    </select>
                    @error('car_model_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Year -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Year</label>
                    <select name="year_id" id="year" class="form-control @error('year_id') is-invalid @enderror" required>
                        <option value="">-- Select Year --</option>
                    </select>
                    @error('year_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Note -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Additional Notes</label>
                    <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="2">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Images -->
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Images</label>
                    <div class="custom-file mb-3">
                        <input type="file" name="main_image" class="custom-file-input @error('main_image') is-invalid @enderror" id="mainImage">
                        <label class="custom-file-label" for="mainImage">Main Image</label>
                        @error('main_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" name="image_1" class="custom-file-input @error('image_1') is-invalid @enderror" id="image1">
                        <label class="custom-file-label" for="image1">Image 2</label>
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" name="image_2" class="custom-file-input @error('image_2') is-invalid @enderror" id="image2">
                        <label class="custom-file-label" for="image2">Image 3</label>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="image_3" class="custom-file-input @error('image_3') is-invalid @enderror" id="image3">
                        <label class="custom-file-label" for="image3">Image 4</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save fa-fw"></i> Create Part
            </button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.getElementById('make').addEventListener('change', function() {
    const makeId = this.value;
    const modelDropdown = document.getElementById('model');

    // Clear existing options
    modelDropdown.innerHTML = '<option value="">--Select Model--</option>';

    if (makeId) {
        // Use your existing named route with query parameter
        fetch(`{{ route('api.models') }}?make_id=${makeId}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(models => {
                models.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelDropdown.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching models:', error);
                modelDropdown.innerHTML = '<option value="">Error loading models</option>';
            });
    }
});


document.getElementById('model').addEventListener('change', function() {
    const modelId = this.value;
    const yearDropdown = document.getElementById('year');
    
    // Clear existing options
    yearDropdown.innerHTML = '<option value="">--Select Year--</option>';

    if (modelId) {
        fetch(`{{ route('api.years') }}?model_id=${modelId}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(years => {
                if (years.length === 0) {
                    const option = document.createElement('option');
                    option.textContent = 'No years available';
                    option.disabled = true;
                    yearDropdown.appendChild(option);
                } else {
                    years.forEach(year => {
                        const option = document.createElement('option');
                        option.value = year.id;
                        option.textContent = year.year;
                        yearDropdown.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching years:', error);
                yearDropdown.innerHTML = '<option value="">Error loading years</option>';
            });
    }
});


document.addEventListener('DOMContentLoaded', function () {
    // Function to update file input label
    function updateFileName(input) {
        if (input.files.length > 0) {
            input.nextElementSibling.textContent = input.files[0].name;
        } else {
            input.nextElementSibling.textContent = 'Choose file';
        }
    }

    // Select all file inputs and add event listeners
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function () {
            updateFileName(this);
        });
    });
});

</script>
@endsection