$(document).ready( function () {

    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    // ===============================================
    // adding new building
    $(document).on('click', '#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'name_of_building' : $('#name_of_building').val(),
            'area_acquired' : $('#area_acquired').val(),
            'location' : $('#location').val(),
            'make' : $('#make').val(),
            'number_of_floors' : $('#number_of_floors').val(),
            'total_floor_area' : $('#total_floor_area').val(),
            'condition' : $('#condition').val(),
            'current_use' : $('#current_use').val(),
            'num_of_rooms' : $('#num_of_rooms').val(),
            'date_constructed' : $('#date_constructed').val(),
            'how_acquired' : $('#how_acquired').val(),
            'cost' : $('#cost').val()
        }
        $.ajax({
            type: "POST",
            url: "/admin/properties/buildings/store",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response)
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
        var building = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/buildings/edit/"+building,
            success: function (response) {
                console.log(response);
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.building.id);
                    $('#edit_name_of_building').val(response.building.name_of_building);
                    $('#edit_area_acquired').val(response.building.area_acquired);
                    $('#edit_location').val(response.building.location);
                    $('#edit_make').val(response.building.make);
                    $('#edit_number_of_floors').val(response.building.num_of_floors);
                    $('#edit_total_floor_area').val(response.building.total_floor_area);
                    $('#edit_condition').val(response.building.condition);
                    $('#edit_current_use').val(response.building.current_use);
                    $('#edit_num_of_rooms').val(response.building.num_of_rooms);
                    $('#edit_date_constructed').val(response.building.date_constructed);
                    $('#edit_how_acquired').val(response.building.how_acquired);
                    $('#edit_cost').val(response.building.cost);
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
        var building_id = $('#edit_id').val();
        var data = {
            'name_of_building': $('#edit_name_of_building').val(),
            'area_acquired': $('#edit_area_acquired').val(),
            'location': $('#edit_location').val(),
            'make': $('#edit_make').val(),
            'num_of_floors': $('#edit_number_of_floors').val(),
            'total_floor_area': $('#edit_total_floor_area').val(),
            'condition': $('#edit_condition').val(),
            'current_use': $('#edit_current_use').val(),
            'num_of_rooms': $('#edit_num_of_rooms').val(),
            'date_constructed': $('#edit_date_constructed').val(),
            'how_acquired': $('#edit_how_acquired').val(),
            'cost': $('#edit_cost').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/buildings/edit/save/"+building_id,
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
        var building_id = $(this).val();

        $('#delete_id').val(building_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var building_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/buildings/delete/confirm/"+building_id,
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
    $('#number_of_floors').keyup(function (e) { 
    var area_aquired = $('#area_acquired').val();
    $('#total_floor_area').val($(this).val() * area_aquired);
    });
    $('#area_acquired').keyup(function (e) { 
        var units = $('#number_of_floors').val();
        $('#total_floor_area').val($(this).val() * units);
    });
    $('#edit_number_of_floors').keyup(function (e) { 
        var area_aquired = $('#edit_area_acquired').val();
        $('#edit_total_floor_area').val($(this).val() * area_aquired);
    });
    $('#edit_area_acquired').keyup(function (e) { 
        var units = $('#edit_number_of_floors').val();
        $('#edit_total_floor_area').val($(this).val() * units);
    });
});