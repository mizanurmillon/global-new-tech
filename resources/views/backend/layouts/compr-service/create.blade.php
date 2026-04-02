@extends('backend.layouts.app')
@section('title', isset($compr_service) ? 'Edit Comprehensive Service' : 'Add Comprehensive Service')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($compr_service) ? 'Edit Comprehensive Service' : 'Add Comprehensive Service'" :breadcrumbs="[
            ['text' => 'Comprehensive Service List', 'url' => route('admin.compr-services.index')],
            ['text' => isset($compr_service) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form action="{{ isset($compr_service) ? route('admin.compr-services.update', $compr_service->id) : route('admin.compr-services.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($compr_service))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $compr_service->title ?? '') }}" placeholder="Enter the service title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Short Description</label>
                        <textarea name="short_description" id="" rows="3" class="form-control @error('short_description') is-invalid @enderror" placeholder="Enter the short description">{{ old('short_description', $compr_service->short_description ?? '') }}</textarea>
                        <p class="text-muted">Brief overview of the service max 500 characters.</p>
                         @error('short_description')
                            <span class="invalid-feedback mb-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Icon</label>
                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror">
                         @error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <p class="text-muted">Upload an image for the service icon (max 5MB).</p>
                        @if (isset($compr_service) && $compr_service->icon)
                            <img src="{{ asset($compr_service->icon) }}" height="60" class="mt-2">
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label>Description</label>
                        <textarea id="summernote" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter the service description">{{ old('description', $compr_service->description ?? '') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.compr-services.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($compr_service) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#summernote').summernote({
            height: 200
        });
    </script>
@endsection