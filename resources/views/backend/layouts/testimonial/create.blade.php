@extends('backend.layouts.app')
@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($testimonial) ? 'Edit Testimonial' : 'Add Testimonial'" :breadcrumbs="[
            ['text' => 'Testimonial List', 'url' => route('admin.testimonials.index')],
            ['text' => isset($testimonial) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form method="POST"
                action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($testimonial))
                    @method('PUT')
                @endif

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $testimonial->name ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Position</label>
                        <input type="text" name="position" class="form-control"
                            value="{{ old('position', $testimonial->position ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Bio</label>
                        <input type="text" name="bio" class="form-control"
                            value="{{ old('bio', $testimonial->bio ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Rating (1-5)</label>
                        <input type="number" name="rating" class="form-control" min="1" max="5"
                            value="{{ old('rating', $testimonial->rating ?? '') }}">
                    </div>

                    <div class="col-12 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @if (isset($testimonial) && $testimonial->image)
                            <img src="{{ asset($testimonial->image) }}" height="60" class="mt-2">
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label>Testimonial Text</label>
                        <textarea name="text" class="form-control" rows="4">{{ old('text', $testimonial->text ?? '') }}</textarea>
                    </div>

                </div>

                <div class="text-end">
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($testimonial) ? 'Update' : 'Save' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
