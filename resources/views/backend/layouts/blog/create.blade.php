@extends('backend.layouts.app')
@section('title', isset($blog) ? 'Edit Blog' : 'Add Blog')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($blog) ? 'Edit Blog' : 'Add Blog'" :breadcrumbs="[
            ['text' => 'Blog List', 'url' => route('admin.blogs.index')],
            ['text' => isset($blog) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form action="{{ isset($blog) ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($blog))
                    @method('PUT')
                @endif

                <div class="row">

                    {{-- Title --}}
                    <div class="col-md-6 mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $blog->title ?? '') }}">
                    </div>

                    {{-- Image --}}
                    <div class="col-md-6 mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">

                        @if (isset($blog) && $blog->image)
                            <img src="{{ asset($blog->image) }}" height="60" class="mt-2">
                        @endif
                    </div>

                    {{-- Short Description --}}
                    <div class="col-md-12 mb-3">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $blog->short_description ?? '') }} </textarea>
                    </div>

                    {{-- Long Description (Summernote) --}}
                    <div class="col-12 mb-3">
                        <label>Long Description</label>
                        <textarea id="summernote" name="long_description" class="form-control">{{ old('long_description', $blog->long_description ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="text-end mt-3">
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($blog) ? 'Update' : 'Save' }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
