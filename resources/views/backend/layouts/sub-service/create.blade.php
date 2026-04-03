@extends('backend.layouts.app')
@section('title', isset($subService) ? 'Edit Sub Service' : 'Add Sub Service')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($subService) ? 'Edit Sub Service' : 'Add Sub Service'" :breadcrumbs="[
            ['text' => 'Sub Service List', 'url' => route('admin.sub-services.index')],
            ['text' => isset($subService) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4">
            <form
                action="{{ isset($subService) ? route('admin.sub-services.update', $subService->id) : route('admin.sub-services.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($subService))
                    @method('PUT')
                @endif

                <div class="row">

                    {{-- Core Service Select --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Core Service <span class="text-danger">*</span></label>
                        <select name="core_service_id" class="form-select @error('core_service_id') is-invalid @enderror">
                            <option value="">-- Select Core Service --</option>
                            @foreach ($coreServices as $id => $title)
                                <option value="{{ $id }}"
                                    {{ old('core_service_id', $subService->core_service_id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                        @error('core_service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Sub Service Title --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Service Title <span class="text-danger">*</span></label>
                        <input type="text" name="sub_service_title"
                            class="form-control @error('sub_service_title') is-invalid @enderror"
                            value="{{ old('sub_service_title', $subService->sub_service_title ?? '') }}">
                        @error('sub_service_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Sub Title --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Service Sub Title</label>
                        <input type="text" name="sub_service_sub_title"
                            class="form-control @error('sub_service_sub_title') is-invalid @enderror"
                            value="{{ old('sub_service_sub_title', $subService->sub_service_sub_title ?? '') }}">
                        @error('sub_service_sub_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Icon --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Service Icon</label>
                        <input type="file" name="sub_service_icon"
                            class="form-control @error('sub_service_icon') is-invalid @enderror">
                        @error('sub_service_icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if (isset($subService) && $subService->sub_service_icon)
                            <img src="{{ asset($subService->sub_service_icon) }}" height="50" class="mt-2 rounded">
                        @endif
                    </div>

                    {{-- Description - Summernote --}}
                    <div class="col-12 mb-3">
                        <label class="form-label">Sub Service Description</label>
                        <textarea id="sub_service_description" name="sub_service_description"
                            class="form-control @error('sub_service_description') is-invalid @enderror">{{ old('sub_service_description', $subService->sub_service_description ?? '') }}</textarea>
                        @error('sub_service_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="text-end mt-3">
                    <a href="{{ route('admin.sub-services.index') }}" class="btn btn-secondary me-2">Back</a>
                    <button class="btn btn-primary">
                        {{ isset($subService) ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#sub_service_description').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    </script>
@endsection
