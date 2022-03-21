$(document).ready( function () {
    // Filter Maintenance table
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    
    // ======================================================
    // on change date event
    $('#date_start').change(function () { 
        let date_start = new Date($(this).val());

        if($('#date_end').val() != ''){
            let date_end = new Date($('#date_end').val());

            let difference = Math.abs(date_end - date_start);
            days = difference/(1000 * 3600 * 24)+1;

            if(date_start.getTime() > date_end.getTime()){
                $('#date_start').val('');
            }else{
                $('#working_days').val(days);
            }
        }
    });
    $('#date_end').change(function () { 
        let date_end = new Date($(this).val());

        if($('#date_start').val() != ''){
            let date_start = new Date($('#date_start').val());

            let difference = Math.abs(date_end - date_start);
            days = difference/(1000 * 3600 * 24)+1;

            if(date_start.getTime() > date_end.getTime()){
                $('#date_start').val('');
            }else{
                $('#working_days').val(days);
            }
        }
    });
    // ================================================
    // submit the schedule
    $(document).on('click','#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');

            var data = {
                'date_start' : $('#date_start').val(),
                'date_end' : $('#date_end').val(),
                'working_days' : $('#working_days').val(),
                'office' : $('#office').val(),
                'units' : $('#units').val(),
                'article' : $('#article').val(),
            }
            $.ajax({
                type: "POST",
                url: "/admin/properties/maintenances/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        swal({
                            text: response.message
                        });
                    }else if(response.status == 404){
                        swal({
                            text: "Something went wrong..."
                        });
                    }else if(response.status == 500){
                        swal({
                            text: "Something went wrong when saving data..."
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
        var maintenance_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/maintenances/edit/"+maintenance_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.maintenance.id);
                    $('#edit_date_start').val(response.maintenance.date_start);
                    $('#edit_date_end').val(response.maintenance.date_end);
                    $('#edit_working_days').val(response.maintenance.working_days);
                    $('#edit_office').val(response.maintenance.office);
                    $('#edit_units').val(response.maintenance.units);
                    $('#edit_article').val(response.maintenance.article);
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
        var maintenance_id = $('#edit_id').val();
        var data = {
            'date_start': $('#edit_date_start').val(),
            'date_end': $('#edit_date_end').val(),
            'working_days': $('#edit_working_days').val(),
            'office': $('#edit_office').val(),
            'units': $('#edit_units').val(),
            'article': $('#edit_article').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/maintenances/edit/save/"+maintenance_id,
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
        var maintenance_id = $(this).val();

        $('#delete_id').val(maintenance_id);
        $('#deleteModal').modal('show');
    });
     // Confirmed delete data
     $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var maintenance_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/maintenances/delete/confirm/"+maintenance_id,
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
