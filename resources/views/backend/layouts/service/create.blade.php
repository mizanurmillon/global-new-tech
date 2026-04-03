@extends('backend.layouts.app')
@section('title', isset($service) ? 'Edit Service' : 'Add Service')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs :title="isset($service) ? 'Edit Service' : 'Add Service'" :breadcrumbs="[
            ['text' => 'Service List', 'url' => route('admin.services.index')],
            ['text' => isset($service) ? 'Edit' : 'Create'],
        ]" />

        <form action="{{ isset($service) ? route('admin.services.update', $service->id) : route('admin.services.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($service))
                @method('PUT')
            @endif

            {{-- ===================== HERO SECTION ===================== --}}
            <div class="card mb-4">
                <div class="card-header fw-semibold">Hero Section</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="hero_title"
                                class="form-control @error('hero_title') is-invalid @enderror"
                                value="{{ old('hero_title', $service->hero_title ?? '') }}">
                            @error('hero_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hero Description</label>
                            <input type="text" name="hero_description"
                                class="form-control @error('hero_description') is-invalid @enderror"
                                value="{{ old('hero_description', $service->hero_description ?? '') }}">
                            @error('hero_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hero Image</label>
                            <input type="file" name="hero_image" class="dropify"
                                data-default-file="{{ isset($service->hero_image) ? asset($service->hero_image) : asset('backend/assets/images/image_placeholder.png') }}">

                        </div>

                    </div>
                </div>
            </div>

            {{-- ===================== MAIN SERVICE SECTION ===================== --}}
            <div class="card mb-4">
                <div class="card-header fw-semibold">Main Service Section</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Section Title</label>
                            <input type="text" name="main_section_title"
                                class="form-control @error('main_section_title') is-invalid @enderror"
                                value="{{ old('main_section_title', $service->main_section_title ?? '') }}">
                            @error('main_section_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Section Subtitle</label>
                            <input type="text" name="main_section_subtitle"
                                class="form-control @error('main_section_subtitle') is-invalid @enderror"
                                value="{{ old('main_section_subtitle', $service->main_section_subtitle ?? '') }}">
                            @error('main_section_subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== SERVICE DETAILS ===================== --}}
            <div class="card mb-4">
                <div class="card-header fw-semibold">Service Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Service Title <span class="text-danger">*</span></label>
                            <input type="text" name="service_title"
                                class="form-control @error('service_title') is-invalid @enderror"
                                value="{{ old('service_title', $service->service_title ?? '') }}">
                            @error('service_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Service Icon</label>
                            <input type="file" name="service_icon"
                                class="form-control @error('service_icon') is-invalid @enderror">
                            @error('service_icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if (isset($service) && $service->service_icon)
                                <img src="{{ asset($service->service_icon) }}" height="50" class="mt-2 rounded">
                            @endif
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Service Subtitle</label>
                            <input type="text" name="service_subtitle"
                                class="form-control @error('service_subtitle') is-invalid @enderror"
                                value="{{ old('service_subtitle', $service->service_subtitle ?? '') }}">
                            @error('service_subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-12 mb-3">
                            <label class="form-label">Service Description</label>
                            <textarea id="service_description" name="service_description"
                                class="form-control @error('service_description') is-invalid @enderror">{{ old('service_description', $service->service_description ?? '') }}</textarea>
                            @error('service_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== NUMBERING VALUES ===================== --}}
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Numbering Values</span>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-value-btn">
                        <i class="fas fa-plus me-1"></i> Add Value
                    </button>
                </div>
                <div class="card-body">
                    <div id="values-wrapper">
                        @php
                            $existingValues = isset($service) ? $service->serviceValues : collect();
                            $valuesData = old('values', $existingValues->toArray());
                        @endphp

                        @forelse($valuesData as $vIndex => $val)
                            <div class="value-row border rounded p-3 mb-3 position-relative">
                                <button type="button"
                                    class="btn btn-sm btn-danger remove-row position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Value Title</label>
                                        <input type="text" name="values[{{ $vIndex }}][value_title]"
                                            class="form-control @error("values.{$vIndex}.value_title") is-invalid @enderror"
                                            value="{{ $val['value_title'] ?? '' }}">
                                        @error("values.{$vIndex}.value_title")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Value Sub Title</label>
                                        <input type="text" name="values[{{ $vIndex }}][value_sub_title]"
                                            class="form-control @error("values.{$vIndex}.value_sub_title") is-invalid @enderror"
                                            value="{{ $val['value_sub_title'] ?? '' }}">
                                        @error("values.{$vIndex}.value_sub_title")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Value (Number)</label>
                                        <input type="text" name="values[{{ $vIndex }}][value]"
                                            class="form-control @error("values.{$vIndex}.value") is-invalid @enderror"
                                            value="{{ $val['value'] ?? '' }}" placeholder="e.g. 500+">
                                        @error("values.{$vIndex}.value")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- Empty placeholder when no values --}}
                        @endforelse
                    </div>

                    <p class="text-muted small mb-0" id="values-empty-msg"
                        style="{{ count($valuesData) ? 'display:none' : '' }}">
                        No values added yet. Click "Add Value" to add numbering stats.
                    </p>
                </div>
            </div>

            {{-- ===================== HOW IT WORKS ===================== --}}
            <div class="card mb-4">
                <div class="card-header justify-content-between align-items-center ">
                    <span class="fw-semibold">How It Works</span>

                    <button type="button" class="btn btn-sm btn-outline-primary ms-3  float-end" id="add-htw-btn">
                        <i class="fas fa-plus me-1"></i> Add Step
                    </button>
                    <div class="row my-2">
                        <div class="col-md-6">
                            <input type="text" name="work_section_title" placeholder="Work Section Title"
                                class="form-control @error('work_section_title') is-invalid @enderror"
                                value="{{ old('work_section_title', $service->work_section_title ?? '') }}">
                            @error('work_section_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="work_section_subtitle" placeholder="Work Section Subtitle"
                                class="form-control @error('work_section_subtitle') is-invalid @enderror"
                                value="{{ old('work_section_subtitle', $service->work_section_subtitle ?? '') }}">
                            @error('work_section_subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="htw-wrapper">
                        @php
                            $existingHtw = isset($service) ? $service->howToWorkServices : collect();
                            $htwData = old('how_to_works', $existingHtw->toArray());
                        @endphp

                        @forelse($htwData as $hIndex => $htw)
                            <div class="htw-row border rounded p-3 mb-3 position-relative">
                                <input type="hidden" name="how_to_works[{{ $hIndex }}][existing_icon]"
                                    value="{{ $htw['how_to_work_icon'] ?? '' }}">

                                <button type="button"
                                    class="btn btn-sm btn-danger remove-row position-absolute top-0 end-0 m-2">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Step Title</label>
                                        <input type="text" name="how_to_works[{{ $hIndex }}][how_to_work_title]"
                                            class="form-control @error("how_to_works.{$hIndex}.how_to_work_title") is-invalid @enderror"
                                            value="{{ $htw['how_to_work_title'] ?? '' }}">
                                        @error("how_to_works.{$hIndex}.how_to_work_title")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Step Sub Title</label>
                                        <input type="text"
                                            name="how_to_works[{{ $hIndex }}][how_to_work_sub_title]"
                                            class="form-control @error("how_to_works.{$hIndex}.how_to_work_sub_title") is-invalid @enderror"
                                            value="{{ $htw['how_to_work_sub_title'] ?? '' }}">
                                        @error("how_to_works.{$hIndex}.how_to_work_sub_title")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label">Step Icon</label>
                                        <input type="file" name="how_to_works[{{ $hIndex }}][how_to_work_icon]"
                                            class="form-control @error("how_to_works.{$hIndex}.how_to_work_icon") is-invalid @enderror">
                                        @error("how_to_works.{$hIndex}.how_to_work_icon")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (!empty($htw['how_to_work_icon']))
                                            <img src="{{ asset($htw['how_to_work_icon']) }}" height="40"
                                                class="mt-1 rounded">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- Empty placeholder --}}
                        @endforelse
                    </div>

                    <p class="text-muted small mb-0" id="htw-empty-msg"
                        style="{{ count($htwData) ? 'display:none' : '' }}">
                        No steps added yet. Click "Add Step" to add how-it-works items.
                    </p>
                </div>
            </div>

            {{-- ===================== SUBMIT ===================== --}}
            <div class="text-end mb-4">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary me-2">Back</a>
                <button class="btn btn-primary">
                    {{ isset($service) ? 'Update Service' : 'Save Service' }}
                </button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // ---- Summernote ----
        $('#service_description').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        // ---- Repeatable Value Rows ----
        let valueIndex = {{ count($valuesData) }};

        $('#add-value-btn').on('click', function() {
            $('#values-empty-msg').hide();
            const html = `
                <div class="value-row border rounded p-3 mb-3 position-relative">
                    <button type="button" class="btn btn-sm btn-danger remove-row position-absolute top-0 end-0 m-2">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Value Title</label>
                            <input type="text" name="values[${valueIndex}][value_title]" class="form-control" placeholder="e.g. Projects Done">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Value Sub Title</label>
                            <input type="text" name="values[${valueIndex}][value_sub_title]" class="form-control" placeholder="e.g. Completed">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Value (Number)</label>
                            <input type="text" name="values[${valueIndex}][value]" class="form-control" placeholder="e.g. 500+">
                        </div>
                    </div>
                </div>`;
            $('#values-wrapper').append(html);
            valueIndex++;
        });

        // ---- Repeatable How-to-Work Rows ----
        let htwIndex = {{ count($htwData) }};

        $('#add-htw-btn').on('click', function() {
            $('#htw-empty-msg').hide();
            const html = `
                <div class="htw-row border rounded p-3 mb-3 position-relative">
                    <button type="button" class="btn btn-sm btn-danger remove-row position-absolute top-0 end-0 m-2">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Step Title</label>
                            <input type="text" name="how_to_works[${htwIndex}][how_to_work_title]" class="form-control" placeholder="Step title">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Step Sub Title</label>
                            <input type="text" name="how_to_works[${htwIndex}][how_to_work_sub_title]" class="form-control" placeholder="Step sub title">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Step Icon</label>
                            <input type="file" name="how_to_works[${htwIndex}][how_to_work_icon]" class="form-control">
                        </div>
                    </div>
                </div>`;
            $('#htw-wrapper').append(html);
            htwIndex++;
        });

        // ---- Remove row ----
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.value-row, .htw-row').remove();
            if ($('#values-wrapper .value-row').length === 0) $('#values-empty-msg').show();
            if ($('#htw-wrapper .htw-row').length === 0) $('#htw-empty-msg').show();
        });
    </script>
@endsection
