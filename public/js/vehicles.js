$(document).ready( function () {

    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
      // ===============================================
    // adding new vehicle
    $(document).on('click', '#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'article' : $('#article').val(),
            'requisitioner' : $('#requisitioner').val(),
            'deployment' : $('#deployment').val(),
            'property_number' : $('#property_number').val(),
            'registration_date' : $('#registration_date').val(),
            'remarks' : $('#remarks').val(),
            'units' : $('#units').val(),
            'unit_value' : $('#unit_value').val(),
            'total_value' : $('#total_value').val(),
            'description' : $('#description').val()
        }
        $.ajax({
            type: "POST",
            url: "/admin/properties/vehicles/store",
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
        var vehicle = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/vehicles/edit/"+vehicle,
            success: function (response) {
                console.log(response);
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                   
                    $('#edit_id').val(response.vehicle.id);
                    $('#edit_article').val(response.vehicle.article);
                    $('#edit_requisitioner').val(response.vehicle.requisitioner);
                    $('#edit_deployment').val(response.vehicle.deployment);
                    $('#edit_property_number').val(response.vehicle.property_number);
                    $('#edit_registration_date').val(response.vehicle.registration_date);
                    $('#edit_remarks').val(response.vehicle.remarks);
                    $('#edit_units').val(response.vehicle.units);
                    $('#edit_unit_value').val(response.vehicle.unit_value);
                    $('#edit_total_value').val(response.vehicle.total_value);
                    $('#edit_description').val(response.vehicle.description);
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
        var vehicle_id = $('#edit_id').val();
        var data = {
            'article': $('#edit_article').val(),
            'requisitioner': $('#edit_requisitioner').val(),
            'deployment': $('#edit_deployment').val(),
            'property_number': $('#edit_property_number').val(),
            'registration_date': $('#edit_registration_date').val(),
            'remarks': $('#edit_remarks').val(),
            'units': $('#edit_units').val(),
            'unit_value': $('#edit_unit_value').val(),
            'total_value': $('#edit_total_value').val(),
            'description': $('#edit_description').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/vehicles/edit/save/"+vehicle_id,
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
        var vehicle_id = $(this).val();

        $('#delete_id').val(vehicle_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var vehicle_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/vehicles/delete/confirm/"+vehicle_id,
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
    // calculation of total value for adding new equipment
    $('#units').keyup(function (e) { 
        var unit_value = $('#unit_value').val();
        $('#total_value').val($(this).val() * unit_value);
    });
    // calculation of total value for adding new equipment
    $('#unit_value').keyup(function (e) { 
        var units = $('#units').val();
        $('#total_value').val($(this).val() * units);
    });
});