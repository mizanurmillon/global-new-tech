@extends('backend.layouts.app')
@section('title', 'Brands')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Brands" subtitle="Manage all brands" />

        <div class="card">
            <div class="card-body">
                <x-table-header title="Brands" :route="route('admin.brands.create')" />

                <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Website</th>
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
@endsection
@section('modal') <x-status-modal /> @endsection
@section('script')
    <script>
        $(function() {
            let dt = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.brands.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'logo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'website_url',
                        name: 'website_url'
                    },
                    {
                        data: 'is_active',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
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

            // Account status toggle
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
                const isEnabled = $('#status_enabled').val();
                $.ajax({
                    url: '{{ route('admin.brands.status', ':id') }}'.replace(':id', id),
                    type: 'PATCH',
                    data: {
                        is_active: isEnabled
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

            // Delete brand
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
                    url: "{{ route('admin.brands.destroy', ':id') }}".replace(':id', id),
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
