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
                       data: 'position',
                       name: 'position'
                   },
                   {
                       data: 'image',
                       name: 'image',
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

           // Delete user
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
