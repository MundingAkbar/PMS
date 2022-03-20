$(document).ready( function () {
    // ===============================================
    // adding new office/department
    $(document).on('click', '.btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'office_name' : $('#office_name').val(),
        }
        
        $.ajax({
            type: "POST",
            url: "/admin/properties/offices/store",
            data: data,
            dataType: "json",
            success: function (response) {
                if( response.status == 400 ){
                    swal({
                        text: 'Something went wrong...',
                    });
                }else if(response.status == 200){
                    swal({
                        text: response.message
                    });
                    $('#myTable').DataTable().ajax.reload(null, false);
                    $('#exampleModal').modal('hide');
                }else{
                    swal({
                        text: response.message,
                    });
                }
                $('.btn_submit').text('Submit');
            }
        });
    });
// =========================================================
    // fetching data to edit modal form
    $(document).on('click', '.btn_edit', function (e) {
        e.preventDefault();
        $(this).text('Fetching Data...');
        var office_id = $(this).val();
        
        $.ajax({
            type: "GET",
            url: "/admin/properties/offices/edit/"+office_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.office.id);
                    $('#edit_office_name').val(response.office.office_name);
                }

                $('.btn_edit').text('Update');
            }
        });
    });
    // =====================================================
    // updating record
    $(document).on('click', '#update_btn', function (e) {
        e.preventDefault();
        $(this).text('Updating...');
        var office_id = $('#edit_id').val();
        var data = {
            'office_name': $('#edit_office_name').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/offices/edit/save/"+office_id,
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
               $('#update_btn').text('Update');
               $('#myTable').DataTable().ajax.reload(null, false);
            }
        });

    });
    // ===============================================
    // fetching the delete data
    $(document).on('click','.btn_delete', function (e) {
        e.preventDefault();
        var office_id = $(this).val();

        $('#delete_id').val(office_id);
        $('#deleteModal').modal('show');
    });
    // Confirmed delete data
    $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var office_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/offices/delete/confirm/"+office_id,
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