@extends('backend.layouts.app')
@section('title', 'Testimonial Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Testimonial Details" />

        <div class="card p-4">

            <div class="text-center mb-4">
                @if ($testimonial->image)
                    <img src="{{ asset($testimonial->image) }}" height="100" style="border-radius:50%">
                @endif
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td>{{ $testimonial->name }}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{ $testimonial->position }}</td>
                </tr>
                <tr>
                    <th>Bio</th>
                    <td>{{ $testimonial->bio }}</td>
                </tr>
                <tr>
                    <th>Rating</th>
                    <td>{{ $testimonial->rating }}</td>
                </tr>
                <tr>
                    <th>Text</th>
                    <td>{{ $testimonial->text }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        {!! $testimonial->is_active
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                </tr>
            </table>

            <div class="text-end">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
            </div>

        </div>
    </div>
@endsection
