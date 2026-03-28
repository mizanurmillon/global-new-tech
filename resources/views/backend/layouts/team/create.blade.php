@extends('backend.layouts.app')
@section('title', isset($team) ? 'Edit Team Member' : 'Add Team Member')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="{{ isset($team) ? 'Edit Team Member' : 'Add Team Member' }}" :breadcrumbs="[
            ['text' => 'Team Members', 'url' => route('admin.team.index')],
            ['text' => isset($team) ? 'Edit' : 'Create'],
        ]" />

        <div class="card p-4 shadow-sm">
            <form action="{{ isset($team) ? route('admin.team.update', $team->id) : route('admin.team.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($team))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label fw-bold">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $team->name ?? '') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label fw-bold">Position</label>
                        <input type="text" name="position" id="position" class="form-control"
                            value="{{ old('position', $team->position ?? '') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Image</label>
                        <input type="file" name="image" class="dropify"
                            data-default-file="{{ isset($team->image) ? asset($team->image) : asset('backend/assets/images/image_placeholder.png') }}" />
                    </div>
                </div>
              
                <div class="text-end mt-3">
                    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary px-4 me-2">Back</a>
                    <button type="submit" class="btn btn-primary px-4">{{ isset($team) ? 'Update' : 'Save' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
