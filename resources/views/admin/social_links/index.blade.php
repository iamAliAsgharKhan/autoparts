@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Social Links Management</h6>
        <a href="{{ route('admin.social_links.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Add New Link
        </a>
    </div>
    <div class="card-body">
        {{-- Display Success/Error Messages --}}
        @include('partials.admin.flash-messages') {{-- Or copy the specific if blocks --}}

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Platform</th>
                        <th>URL</th>
                        <th>Icon Preview</th>
                        <th>Icon Class</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($socialLinks as $link)
                    <tr>
                        <td>{{ $link->id }}</td>
                        <td>{{ $link->platform_name }}</td>
                        <td><a href="{{ $link->url }}" target="_blank">{{ Str::limit($link->url, 40) }}</a></td>
                        <td class="text-center">
                            @if($link->icon)
                                <i class="{{ $link->icon }}" style="font-size: 1.5rem;"></i>
                            @else
                                N/A
                            @endif
                        </td>
                         <td><code>{{ $link->icon }}</code></td>
                        <td>
                            {{-- Show Button (Optional) --}}
                            {{-- <a href="{{ route('admin.social_links.show', $link) }}"
                               class="btn btn-sm btn-secondary mb-1" title="View">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('admin.social_links.edit', $link) }}"
                               class="btn btn-sm btn-info mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.social_links.destroy', $link) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this link?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No social links found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- No pagination needed if fetching all --}}
    </div>
</div>
@endsection