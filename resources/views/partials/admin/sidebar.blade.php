<!-- resources/views/partials/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-car"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Auto Parts & Services</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Inventory Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory" aria-expanded="true" aria-controls="collapseInventory">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventory</span>
        </a>
        <div id="collapseInventory" class="collapse" aria-labelledby="headingInventory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Inventory Management:</h6>
                {{-- <a class="collapse-item" href="{{ url('/admin/parts/new') }}">New Parts</a>
                <a class="collapse-item" href="{{ url('/admin/parts/used') }}">Used Parts</a>
                <a class="collapse-item" href="{{ url('/admin/parts/stock') }}">Stock Levels</a>
                <a class="collapse-item" href="{{ url('/admin/parts/suppliers') }}">Suppliers</a> --}}
                
               
                <a class="collapse-item" href="{{ url('/admin/parts/all') }}">View All Parts</a>
                
                <a class="collapse-item" href="{{ route('admin.car_models.index') }}">View All Car Models</a>
                <a class="collapse-item" href="{{ route('admin.makes.index') }}">View All Makes</a>
                <a class="collapse-item" href="{{ route('admin.years.index') }}">View All Years</a>
                <a class="collapse-item" href="{{ url('admin/categories/all') }}">View All Categories</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Services Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseServices" aria-expanded="true" aria-controls="collapseServices">
            <i class="fas fa-fw fa-tools"></i>
            <span>Services</span>
        </a>
        <div id="collapseServices" class="collapse" aria-labelledby="headingServices" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Service Management:</h6>
                <a class="collapse-item" href="{{ url('/admin/services/schedule') }}">Schedule Service</a>
                <a class="collapse-item" href="{{ url('/admin/services/history') }}">Service History</a>
                <a class="collapse-item" href="{{ url('/admin/services/technicians') }}">Technicians</a>
                <a class="collapse-item" href="{{ url('/admin/services/packages') }}">Service Packages</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Customers Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomers" aria-expanded="true" aria-controls="collapseCustomers">
            <i class="fas fa-fw fa-users"></i>
            <span>Customers</span>
        </a>
        <div id="collapseCustomers" class="collapse" aria-labelledby="headingCustomers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer Management:</h6>
                <a class="collapse-item" href="{{ url('/admin/customers/list') }}">Customer List</a>
                <a class="collapse-item" href="{{ url('/admin/customers/orders') }}">Customer Orders</a>
                <a class="collapse-item" href="{{ url('/admin/customers/feedback') }}">Customer Feedback</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Media Management Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMedia" aria-expanded="true" aria-controls="collapseMedia">
            <i class="fas fa-fw fa-images"></i>
            <span>Media Management</span>
        </a>
        <div id="collapseMedia" class="collapse" aria-labelledby="headingMedia" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Media Management:</h6>
                <a class="collapse-item" href="{{ route('admin.social_links.index') }}">Social Links</a>
                <a class="collapse-item" href="{{ url('/admin/media/images') }}">Images</a>
                <a class="collapse-item" href="{{ url('/admin/media/videos') }}">Videos</a>
                <a class="collapse-item" href="{{ url('/admin/media/documents') }}">Documents</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Reports
    </div>

    <!-- Nav Item - Reports Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseReports">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Reports</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingReports" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Reports:</h6>
                <a class="collapse-item" href="{{ url('/admin/reports/sales') }}">Sales Reports</a>
                <a class="collapse-item" href="{{ url('/admin/reports/services') }}">Service Reports</a>
                <a class="collapse-item" href="{{ url('/admin/reports/inventory') }}">Inventory Reports</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
