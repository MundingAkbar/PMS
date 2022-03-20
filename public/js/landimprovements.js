$(document).ready( function () {

    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
       // ===============================================
    // adding new office/department
    $(document).on('click', '#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'name_of_project' : $('#name_of_project').val(),
            'location' : $('#location').val(),
            'project_cost' : $('#project_cost').val(),
        }
        
        $.ajax({
            type: "POST",
            url: "/admin/properties/landimprovements/store",
            data: data,
            dataType: "json",
            success: function (response) {
                if( response.status == 400 ){
                    console.log(response.errors);
                    swal({
                        text: 'Something went wrong...',
                    });
                }else if(response.status == 200){
                    swal({
                        text: response.message
                    });
                    $('#exampleModal').modal('hide');
                }else{
                    swal({
                        text: response.message,
                    });
                }
                $('.btn_submit').text('Submit');
                $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });
        // =========================================================
    // fetching data to edit modal form
    $(document).on('click', '.btn_edit', function (e) {
        e.preventDefault();
        $(this).text('Fetching Data...');
        var land_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/landimprovements/edit/"+land_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.landimprovement.id);
                    $('#edit_name_of_project').val(response.landimprovement.name_of_project);
                    $('#edit_location').val(response.landimprovement.location);
                    $('#edit_project_cost').val(response.landimprovement.project_cost);
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
        var land_id = $('#edit_id').val();
        var data = {
            'name_of_project': $('#edit_name_of_project').val(),
            'location': $('#edit_location').val(),
            'project_cost': $('#edit_project_cost').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/landimprovements/edit/save/"+land_id,
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
        var land_id = $(this).val();

        $('#delete_id').val(land_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var land_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/landimprovements/delete/confirm/"+land_id,
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