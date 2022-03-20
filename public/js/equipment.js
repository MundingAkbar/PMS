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
            'article' : $('#article').val(),
            'requisitioner' : $('#requisitioner').val(),
            'deployment' : $('#deployment').val(),
            'property_number' : $('#property_number').val(),
            'remarks' : $('#remarks').val(),
            'units' : $('#units').val(),
            'unit_value' : $('#unit_value').val(),
            'total_value' : $('#total_value').val(),
            'description' : $('#description').val()
        }
        $.ajax({
            type: "POST",
            url: "/admin/properties/equipment/store",
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
        var equipment = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/equipment/edit/"+equipment,
            success: function (response) {
                console.log(response);
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                   
                    $('#edit_id').val(response.equipment.id);
                    $('#edit_article').val(response.equipment.article);
                    $('#edit_requisitioner').val(response.equipment.requisitioner);
                    $('#edit_deployment').val(response.equipment.deployment);
                    $('#edit_property_number').val(response.equipment.property_number);
                    $('#edit_remarks').val(response.equipment.remarks);
                    $('#edit_units').val(response.equipment.units);
                    $('#edit_unit_value').val(response.equipment.unit_value);
                    $('#edit_total_value').val(response.equipment.total_value);
                    $('#edit_description').val(response.equipment.description);
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
        var equipment_id = $('#edit_id').val();
        var data = {
            'article': $('#edit_article').val(),
            'requisitioner': $('#edit_requisitioner').val(),
            'deployment': $('#edit_deployment').val(),
            'property_number': $('#edit_property_number').val(),
            'remarks': $('#edit_remarks').val(),
            'units': $('#edit_units').val(),
            'unit_value': $('#edit_unit_value').val(),
            'total_value': $('#edit_total_value').val(),
            'description': $('#edit_description').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/equipment/edit/save/"+equipment_id,
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
        var equipment_id = $(this).val();

        $('#delete_id').val(equipment_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var equipment_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/equipment/delete/confirm/"+equipment_id,
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
    $('#edit_units').keyup(function (e) { 
        var unit_value = $('#edit_unit_value').val();
        $('#edit_total_value').val($(this).val() * unit_value);
    });
    // calculation of total value for adding new equipment
    $('#edit_unit_value').keyup(function (e) { 
        var units = $('#edit_units').val();
        $('#edit_total_value').val($(this).val() * units);
    });
});