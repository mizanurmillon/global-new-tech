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
                                        <th>Email</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Status</th>
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
@section('modal') <x-status-modal /> @endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dt = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.team.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'position',
                        name: 'position'
                    },
                    {
                        data: 'avatar_path',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                language: {
                    paginate: {
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>'
                    },
                    processing: dataTableLoader()
                },
            });

            // ---- Status toggle ----
            $(document).on('click', '.change_status', function(e) {
                e.preventDefault();
                $('#status_id').val($(this).data('id'));
                $('#status_enabled').val($(this).data('enabled'));
                $('#status_title').text($(this).data('title'));
                $('#status_description').text($(this).data('description'));
            });

            $('#status_form').on('submit', function(e) {
                e.preventDefault();
                const id = $('#status_id').val();
                const enabled = $('#status_enabled').val();
                $.ajax({
                    url: '{{ route('admin.team.status', ':id') }}'.replace(':id', id),
                    type: 'PATCH',
                    data: {
                        is_active: enabled
                    },
                    success: function(res) {
                        dt.ajax.reload(null, false);
                        successModal('SUCCESSFULLY UPDATED');
                    },
                    error: function(xhr) {
                        errorModal();
                        console.error(xhr.responseText);
                    }
                });
            });

            // ---- Delete ----
            $(document).on('click', '.deletebtn', function(e) {
                e.preventDefault();
                $('#delete_id').val($(this).data('id'));
                $('#delete_type').val($(this).data('type'));
                $('#deletemodal').modal('show');
            });

            $('#delete_modal_clear').on('submit', function(e) {
                e.preventDefault();
                let id = $('#delete_id').val();
                $.ajax({
                    url: "{{ route('admin.team.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        dt.ajax.reload(null, false);
                        successModal('SUCCESSFULLY DELETED');
                    },
                    error: function(xhr) {
                        errorModal();
                        console.error(xhr.responseText || xhr.statusText);
                    }
                });
            });
        });
    </script>
@endsection
