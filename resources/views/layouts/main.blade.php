<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends used auto parts and mechanical services - @yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('additional-styles')
    <link rel="stylesheet" href="{{ asset('startbootstrap/vendor/fontawesome-free/css/all.min.css') }}">
    
</head>
<body>

    @include('partials.front.header')

    @yield('content')

    @include('partials.front.footer')
<script>
document.getElementById('make').addEventListener('change', function () {
    const makeId = this.value;

    // Clear the model dropdown
    const modelDropdown = document.getElementById('model');
    modelDropdown.innerHTML = '<option value="">--Select Model--</option>';

    if (makeId) {
        // Fetch models for the selected make using a named route
        fetch(`{{ route('api.models') }}?make_id=${makeId}`)
            .then(response => response.json())
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
            });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownToggle.addEventListener('click', function(e) {
        e.preventDefault();
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdownToggle.contains(e.target) && !dropdownContent.contains(e.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});

</script>


</body>
</html>