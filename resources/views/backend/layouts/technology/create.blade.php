@extends('backend.layouts.app')
@section('title', isset($technology) ? 'Edit Technology' : 'Add Technology')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($technology) ? 'Edit Technology' : 'Add Technology'" :breadcrumbs="[
            ['text' => 'Technology List', 'url' => route('admin.technologies.index')],
            ['text' => isset($technology) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form
                action="{{ isset($technology) ? route('admin.technologies.update', $technology->id) : route('admin.technologies.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($technology))
                    @method('PUT')
                @endif

                <div class="row">
                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title', $technology->title ?? '') }}" placeholder="Enter technology title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Icon --}}
                    <div class="col-md-6 mb-3">
                        <label>Icon</label>
                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror"
                            accept="image/*">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if (isset($technology) && $technology->icon)
                            <img src="{{ asset($technology->icon) }}" height="60" class="mt-2 rounded">
                        @endif
                    </div>

                    {{-- Status --}}
                    {{-- <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <div class="form-check form-switch mt-1">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                {{ old('is_active', $technology->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div> --}}
                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($technology) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
