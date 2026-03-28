@extends('backend.layouts.app')
@section('title', 'Team Members')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Team Members" subtitle='You can add, edit and delete team members from here' />
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <x-table-header title="Team Members" :route="route('admin.team.create')" />

                        <div class="table-responsive w-100">
                            <table class="table reloadAdminTable table-hover" id="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('backend.layouts.team.partials._teamJS')
@endsection
