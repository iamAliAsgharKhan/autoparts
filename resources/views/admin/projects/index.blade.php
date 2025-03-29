@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Projects Listing</h6>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Project
        </a>
    </div>
    <div class="card-body">
        @include('partials.admin.flash-messages')

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Headline</th>
                        <th>Description (Excerpt)</th>
                        <th>Images (Before/After)</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Use @forelse to handle the empty case --}}
                    @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->headline }}</td>
                        <td>{{ Str::limit(strip_tags($project->description), 100) }}</td> {{-- Strip tags for excerpt --}}
                        <td>
                             {{-- Eager load counts or check existence efficiently if needed for performance --}}
                            <span class="badge badge-secondary">{{ $project->beforeImages()->count() }}</span> /
                            <span class="badge badge-success">{{ $project->afterImages()->count() }}</span>
                        </td>
                        <td>{{ $project->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project) }}"
                               class="btn btn-sm btn-secondary mb-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}"
                               class="btn btn-sm btn-info mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this project and all its images?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    {{-- This part executes only if $projects is empty --}}
                    <tr>
                        <td colspan="6" class="text-center">No projects found. <a href="{{ route('admin.projects.create') }}">Create one now!</a></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         {{-- Pagination Links (will not show if $projects is empty) --}}
         <div class="d-flex justify-content-center">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection