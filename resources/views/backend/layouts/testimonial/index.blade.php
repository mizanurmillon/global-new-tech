@extends('backend.layouts.app')
@section('title', 'Testimonials')

@section('content')
    <div class="content-wrapper">
        <x-breadcrumbs title="Testimonials" subtitle="Manage all testimonials" />

        <div class="card">
            <div class="card-body">
                <x-table-header title="Testimonials" :route="route('admin.testimonials.create')" />

                <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
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
                ajax: "{{ route('admin.testimonials.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'position'
                    },
                    {
                        data: 'rating',
                        orderable: false
                    },
                    {
                        data: 'is_active',
                        orderable: false
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

            $(document).on('click', '.change_status', function(e) {
                e.preventDefault();
                $('#status_id').val($(this).data('id'));
                $('#status_enabled').val($(this).data('enabled'));
                $('#status_title').text($(this).data('title'));
                $('#status_description').text($(this).data('description'));
            });

            $('#status_form').on('submit', function(e) {
                e.preventDefault();
                let id = $('#status_id').val();

                $.ajax({
                    url: "{{ route('admin.testimonials.status', ':id') }}".replace(':id', id),
                    type: 'PATCH',
                    success: function() {
                        dt.ajax.reload(null, false);
                        successModal('SUCCESSFULLY UPDATED');
                    }
                });
            });

            // Delete
            $(document).on('click', '.deletebtn', function(e) {
                e.preventDefault();
                $('#delete_id').val($(this).data('id'));
                $('#deletemodal').modal('show');
            });

            $('#delete_modal_clear').on('submit', function(e) {
                e.preventDefault();
                let id = $('#delete_id').val();

                $.ajax({
                    url: "{{ route('admin.testimonials.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        dt.ajax.reload(null, false);
                        successModal('SUCCESSFULLY DELETED');
                    }
                });
            });
        });
    </script>
@endsection
