@extends('backend.layouts.app')
@section('title', 'Comprehensive Service Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Comprehensive Service Details" />

        <div class="card p-4">

            {{-- Logo --}}
            <div class="text-center mb-4">
                @if ($compr_service->icon)
                    <img src="{{ asset($compr_service->icon) }}" style="border-radius:10%; object-fit:cover; background-color: #000000;" class="rounded">
                @else
                    <span class="text-muted">No Icon</span>
                @endif
            </div>

            {{-- Details Table --}}
            <table class="table table-bordered">

                <tr>
                    <th width="200">Name</th>
                    <td>{{ $compr_service->title }}</td>
                </tr>

                <tr>
                    <th>Subtitle</th>
                    <td>{{ $compr_service->short_description ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        {!! $compr_service->is_active
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>
                        {!! $compr_service->description ?? '<span class="text-muted">No description</span>' !!}
                    </td>
                </tr>

            </table>

            {{-- Back Button --}}
            <div class="text-end mt-3">
                <a href="{{ route('admin.compr-services.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection
