@extends('backend.layouts.app')
@section('title', isset($brand) ? 'Edit Brand' : 'Add Brand')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($brand) ? 'Edit Brand' : 'Add Brand'" :breadcrumbs="[
            ['text' => 'Brand List', 'url' => route('admin.brands.index')],
            ['text' => isset($brand) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form action="{{ isset($brand) ? route('admin.brands.update', $brand->id) : route('admin.brands.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($brand))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $brand->name ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control"
                            value="{{ old('subtitle', $brand->subtitle ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Website</label>
                        <input type="url" name="website_url" class="form-control"
                            value="{{ old('website_url', $brand->website_url ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control">
                        @if (isset($brand) && $brand->logo)
                            <img src="{{ asset($brand->logo) }}" height="60" class="mt-2">
                        @endif
                    </div>

                    <div class="col-12 mb-3">
                        <label>Description</label>
                        <textarea id="summernote" name="description" class="form-control">{{ old('description', $brand->description ?? '') }}</textarea>
                    </div>

                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($brand) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
