@extends('backend.layouts.app')
@section('title', 'Sub Service Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Sub Service Details" :breadcrumbs="[['text' => 'Sub Service List', 'url' => route('admin.sub-services.index')], ['text' => 'Details']]" />

        <div class="card p-4">

            {{-- Icon --}}
            @if ($subService->sub_service_icon)
                <div class="text-center mb-4">
                    <img src="{{ asset($subService->sub_service_icon) }}" height="80" class="rounded">
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th width="220">Core Service</th>
                    <td>{{ $subService->coreService?->service_title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Sub Service Title</th>
                    <td>{{ $subService->sub_service_title }}</td>
                </tr>
                <tr>
                    <th>Sub Service Sub Title</th>
                    <td>{{ $subService->sub_service_sub_title ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{!! $subService->sub_service_description ?? '<span class="text-muted">No description</span>' !!}</td>
                </tr>
            </table>

            <div class="text-end mt-3">
                <a href="{{ route('admin.sub-services.index') }}" class="btn btn-secondary me-2">Back</a>
                <a href="{{ route('admin.sub-services.edit', $subService->id) }}" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>
@endsection
