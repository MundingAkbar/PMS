$(document).ready( function () {
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    
    // fetching single data to update modal
    $(document).on('click', '.edit_btn', function(e){
        e.preventDefault();
        $(this).text('Fetching Data...');
        var user_id = $(this).val();
        $('#updateModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/users/edit/"+user_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.user.id);
                    $('#edit_first_name').val(response.user.first_name);
                    $('#edit_middle_name').val(response.user.middle_name);
                    $('#edit_last_name').val(response.user.last_name);
                    $('#edit_email').val(response.user.email);
                    $('#edit_contact_number').val(response.user.contact_number);
                    $('#edit_office').val(response.user.office);
                    $('#edit_address').val(response.user.address);
                    $('#edit_role').val(response.user.role);
                }

                $('.edit_btn').text('Update');
            }
        });
    })
    // updating the record
    $(document).on('click','#update_btn', function (e) {
       e.preventDefault();
       var user_id = $('#edit_id').val();
       $(this).text('Updating...');
       var data = {
           'office' : $('#edit_office').val(),
           'role' : $('#edit_role').val(),
       };

       $.ajax({
           type: "PUT",
           url: "/users/edit/save/"+user_id,
           data: data,
           dataType: "json",
           success: function (response) {
               if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    swal({
                        text: response.message,
                    });
               }
               $('#updateModal').modal('hide');
               $('#myTable').DataTable().ajax.reload(null, false);
               $('#update_btn').text('Update');
           }
       });
    });
       // ===============================================
    // fetching the delete data
    $(document).on('click','.btn_delete', function (e) {
        e.preventDefault();
        var user_id = $(this).val();

        $('#delete_id').val(user_id);
        $('#deleteModal').modal('show');
    });
        // Confirmed delete data
        $(document).on('click','.delete_btn', function (e) {
            e.preventDefault();
    
            var user_id = $('#delete_id').val();
            $(this).text('Deleting...');
    
            $.ajax({
                type: "DELETE",
                url: "/users/users/delete/"+user_id,
                success: function (response) {
                    swal({
                        text: response.message,
                    });
                    $('.delete_btn').text('Yes Delete');
                    $('#deleteModal').modal('hide');
                    $('#myTable').DataTable().ajax.reload(null, false);
                }
            });
        });
});