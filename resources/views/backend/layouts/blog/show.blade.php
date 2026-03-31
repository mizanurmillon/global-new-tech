@extends('backend.layouts.app')
@section('title', 'Blog Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Blog Details" />

        <div class="card p-4">

            {{-- Image --}}
            <div class="text-center mb-4">
                @if ($blog->image)
                    <img src="{{ asset($blog->image) }}" height="120" class="rounded">
                @else
                    <span class="text-muted">No Image</span>
                @endif
            </div>

            {{-- Details Table --}}
            <table class="table table-bordered">

                <tr>
                    <th width="200">Title</th>
                    <td>{{ $blog->title }}</td>
                </tr>

                <tr>
                    <th>Short Description</th>
                    <td>{{ $blog->short_description ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        {!! $blog->is_active
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                </tr>

                <tr>
                    <th>Long Description</th>
                    <td>
                        {!! $blog->long_description ?? '<span class="text-muted">No description</span>' !!}
                    </td>
                </tr>

            </table>

            {{-- Back Button --}}
            <div class="text-end mt-3">
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection
