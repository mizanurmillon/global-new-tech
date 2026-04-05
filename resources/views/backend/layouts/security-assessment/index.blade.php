@extends('backend.layouts.app')
@section('title', 'Security Assessments')

@section('content')
<div class="content-wrapper">
    <x-breadcrumbs title="Security Assessments" subtitle="Manage all security assessments" />
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assigned By</th>
                            <th>Assigned To</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service Interest</th>
                            <th>Timeline</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<x-status-modal /> @endsection

@section('script')
<script>
    $(function() {

        let dt = $('#data-table').DataTable({
            processing: true
            , serverSide: true
            , ajax: "{{ route('admin.security-assessment.index') }}",

            columns: [{
                    data: 'DT_RowIndex'
                    , orderable: false
                    , searchable: false
                }, {
                    data: 'assigned_by'
                    , name: 'assigned_by'
                }, {
                    data: 'assigned_to'
                    , name: 'assigned_to'
                }
                , {
                    data: 'full_name'
                    , name: 'full_name'
                }
                , {
                    data: 'email'
                    , name: 'email'
                }
                , {
                    data: 'phone_number'
                    , name: 'phone_number'
                }
                , {
                    data: 'security_interest'
                    , name: 'security_interest'
                }
                , {
                    data: 'timeline'
                    , name: 'timeline'
                }
                , {
                    data: 'status'
                    , name: 'status'
                }
                , {
                    data: 'action'
                    , orderable: false
                    , searchable: false
                }
            , ],

            language: {
                paginate: {
                    previous: '<i class="fas fa-angle-left"></i>'
                    , next: '<i class="fas fa-angle-right"></i>'
                }
                , processing: dataTableLoader()
            }
        , });

        //  DELETE
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
                url: "{{ route('admin.security-assessment.destroy', ':id') }}".replace(':id', id)
                , type: 'DELETE'
                , data: {
                    _token: '{{ csrf_token() }}'
                }
                , success: function(res) {
                    dt.ajax.reload(null, false);
                    successModal('SUCCESSFULLY DELETED');
                }
                , error: function(xhr) {
                    errorModal();
                    console.error(xhr.responseText || xhr.statusText);
                }
            });
        });

    });

</script>
@endsection
