@extends('backend.layouts.app')
@section('title', 'Sub Services')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Sub Services" subtitle="Manage all sub services" />

        <div class="card">
            <div class="card-body">
                <x-table-header title="Sub Services" :route="route('admin.sub-services.create')" />

                <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Core Service</th>
                                <th>Sub Title</th>
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

@section('script')
    <script>
        $(function () {
            let dt = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.sub-services.index') }}",
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'sub_service_title', name: 'sub_service_title' },
                    { data: 'sub_service_icon', orderable: false, searchable: false },
                    { data: 'core_service', orderable: false, searchable: false },
                    { data: 'sub_service_sub_title', name: 'sub_service_sub_title' },
                    { data: 'action', orderable: false, searchable: false },
                ],
                language: {
                    paginate: {
                        previous: '<i class="fas fa-angle-left"></i>',
                        next: '<i class="fas fa-angle-right"></i>'
                    },
                    processing: dataTableLoader()
                },
            });

            $(document).on('click', '.deletebtn', function (e) {
                e.preventDefault();
                $('#delete_id').val($(this).data('id'));
                $('#deletemodal').modal('show');
            });

            $('#delete_modal_clear').on('submit', function (e) {
                e.preventDefault();
                let id = $('#delete_id').val();
                $.ajax({
                    url: "{{ route('admin.sub-services.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (res) {
                        dt.ajax.reload(null, false);
                        successModal('SUCCESSFULLY DELETED');
                    },
                    error: function (xhr) {
                        errorModal();
                        console.error(xhr.responseText || xhr.statusText);
                    }
                });
            });
        });
    </script>
@endsection