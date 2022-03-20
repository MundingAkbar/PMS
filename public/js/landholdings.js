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
            'lot_number' : $('#lot_number').val(),
            'classification' : $('#classification').val(),
            'location' : $('#location').val(),
            'date_acquired' : $('#date_acquired').val(),
            'how_acquired' : $('#how_acquired').val(),
            'is_titled' : $('#is_titled').val(),
            'total_area' : $('#total_area').val(),
            'area_type' : $('#area_type').val(),
            'current_utilization' : $('#current_utilization').val(),
        }
        $.ajax({
            type: "POST",
            url: "/admin/properties/landholdings/store",
            data: data,
            dataType: "json",
            success: function (response) {
                if( response.status == 400 ){
                    swal({
                        text: 'something went wrong...',
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
                $('#btn_submit').text('Submit');
            }
        });
    });
    // =========================================================
    // fetching data to edit modal form
    $(document).on('click', '.btn_edit', function (e) {
        e.preventDefault();
        $(this).text('Fetching Data...');
        var landholding = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/landholdings/edit/"+landholding,
            success: function (response) {
                console.log(response);
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{

                    $('#edit_id').val(response.landholding.id);
                    $('#edit_lot_number').val(response.landholding.lot_number);
                    $('#edit_classification').val(response.landholding.classification);
                    $('#edit_location').val(response.landholding.location);
                    $('#edit_date_acquired').val(response.landholding.date_acquired);
                    $('#edit_how_acquired').val(response.landholding.how_acquired);
                    $('#edit_is_titled').val(response.landholding.is_titled);
                    $('#edit_total_area').val(response.landholding.total_area);
                    $('#edit_area_type').val(response.landholding.area_type);
                    $('#edit_current_utilization').val(response.landholding.current_utilization);
                }
                $('.btn_edit').text('Update');
            }
        });
    });
      // =====================================================
    // updating record
    $(document).on('click', '#btn_update', function (e) {
        e.preventDefault();

        $(this).text('Updating...');
        var landholding_id = $('#edit_id').val();
        var data = {
            'lot_number' : $('#edit_lot_number').val(),
            'classification' : $('#edit_classification').val(),
            'location' : $('#edit_location').val(),
            'date_acquired' : $('#edit_date_acquired').val(),
            'how_acquired' : $('#edit_how_acquired').val(),
            'is_titled' : $('#edit_is_titled').val(),
            'total_area' : $('#edit_total_area').val(),
            'area_type' : $('#edit_area_type').val(),
            'current_utilization' : $('#edit_current_utilization').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/landholdings/edit/save/"+landholding_id,
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
               $('#btn_update').text('Update');
               $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });
          // ===============================================
    // fetching the delete data
    $(document).on('click','.btn_delete', function (e) {
        e.preventDefault();
        var landholdings_id = $(this).val();

        $('#delete_id').val(landholdings_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var landholdings_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/landholdings/delete/confirm/"+landholdings_id,
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