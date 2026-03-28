@extends('backend.layouts.app')
@section('title', 'Brand Details')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Brand Details" />

        <div class="card p-4">

            {{-- Logo --}}
            <div class="text-center mb-4">
                @if ($brand->logo)
                    <img src="{{ asset($brand->logo) }}" height="100" class="rounded">
                @else
                    <span class="text-muted">No Logo</span>
                @endif
            </div>

            {{-- Details Table --}}
            <table class="table table-bordered">

                <tr>
                    <th width="200">Name</th>
                    <td>{{ $brand->name }}</td>
                </tr>

                <tr>
                    <th>Subtitle</th>
                    <td>{{ $brand->subtitle ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Website</th>
                    <td>
                        @if ($brand->website_url)
                            <a href="{{ $brand->website_url }}" target="_blank">
                                {{ $brand->website_url }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        {!! $brand->is_active
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger">Inactive</span>' !!}
                    </td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>
                        {!! $brand->description ?? '<span class="text-muted">No description</span>' !!}
                    </td>
                </tr>

            </table>

            {{-- Back Button --}}
            <div class="text-end mt-3">
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>

        </div>
    </div>
@endsection
