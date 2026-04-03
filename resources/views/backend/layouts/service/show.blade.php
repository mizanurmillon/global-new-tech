@extends('backend.layouts.app')
@section('title', 'Service Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Service Details" :breadcrumbs="[['text' => 'Service List', 'url' => route('admin.services.index')], ['text' => 'Details']]" />

        {{-- ===================== HERO SECTION ===================== --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">Hero Section</div>
            <div class="card-body">
                @if ($service->hero_image)
                    <div class="mb-3">
                        <img src="{{ asset($service->hero_image) }}" height="120" class="rounded">
                    </div>
                @endif
                <table class="table table-bordered mb-0">
                    <tr>
                        <th width="220">Hero Title</th>
                        <td>{{ $service->hero_title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Hero Description</th>
                        <td>{{ $service->hero_description ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ===================== MAIN SERVICE SECTION ===================== --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">Main Service Section</div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th width="220">Section Title</th>
                        <td>{{ $service->main_section_title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Section Subtitle</th>
                        <td>{{ $service->main_section_subtitle ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ===================== SERVICE DETAILS ===================== --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">Service Details</div>
            <div class="card-body">
                @if ($service->service_icon)
                    <div class="mb-3">
                        <img src="{{ asset($service->service_icon) }}" height="60" class="rounded">
                    </div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th width="220">Service Title</th>
                        <td>{{ $service->service_title }}</td>
                    </tr>
                    <tr>
                        <th>Service Subtitle</th>
                        <td>{{ $service->service_subtitle ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            {!! $service->is_active
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-danger">Inactive</span>' !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $service->service_description ?? '<span class="text-muted">No description</span>' !!}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ===================== NUMBERING VALUES ===================== --}}
        @if ($service->serviceValues->count())
            <div class="card mb-4">
                <div class="card-header fw-semibold">Numbering Values</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Value Title</th>
                                    <th>Value Sub Title</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service->serviceValues as $i => $val)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $val->value_title ?? 'N/A' }}</td>
                                        <td>{{ $val->value_sub_title ?? 'N/A' }}</td>
                                        <td><strong>{{ $val->value ?? 'N/A' }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        {{-- ===================== HOW IT WORKS ===================== --}}
        <div class="card mb-4">
            <div class="card-header fw-semibold">How It Works</div>
            <div class="card-body">
                <table class="table table-bordered mb-3">
                    <tr>
                        <th width="220">Work Section Title</th>
                        <td>{{ $service->work_section_title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Work Section Subtitle</th>
                        <td>{{ $service->work_section_subtitle ?? 'N/A' }}</td>
                    </tr>
                </table>

                @if ($service->howToWorkServices->count())
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Step Icon</th>
                                    <th>Step Title</th>
                                    <th>Step Sub Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service->howToWorkServices as $i => $htw)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            @if ($htw->how_to_work_icon)
                                                <img src="{{ asset($htw->how_to_work_icon) }}" height="40"
                                                    class="rounded">
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $htw->how_to_work_title ?? 'N/A' }}</td>
                                        <td>{{ $htw->how_to_work_sub_title ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">No how-it-works steps added.</p>
                @endif
            </div>
        </div>

        {{-- ===================== SUB SERVICES ===================== --}}
        @if ($service->subServices->count())
            <div class="card mb-4">
                <div class="card-header fw-semibold">Sub Services</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($service->subServices as $i => $sub)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            @if ($sub->sub_service_icon)
                                                <img src="{{ asset($sub->sub_service_icon) }}" height="40"
                                                    class="rounded">
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>{{ $sub->sub_service_title ?? 'N/A' }}</td>
                                        <td>{{ $sub->sub_service_sub_title ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-end mb-4">
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary me-2">Back</a>
            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
@endsection
