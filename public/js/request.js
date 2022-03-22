$(document).ready( function () {
    // monitoring the array length of selected equipment
    let max_length = 0;
    let equipment_selected = [];
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    $('#requestModal').modal({
        backdrop: 'static',
        keyboard: false
    })
    // emptyig the global array when closing modals
    $('.btn-close').click(function () { 
        equipment_selected.length = 0;
    });
       // ====================================================
    // equipment table
    var equipmentTable = $('#equipmentTable').DataTable({
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { width: '20%', targets: 4 }
        ],
        iDisplayLength: 25,
    })
        // =================================================
    // checking all equipments
    $('#check_all_equipment').click(function () { 
        $('.chk_equipment').prop('checked',$(this).prop('checked'));
        var all_ids = [];
        $('input:checkbox[name="ids"]:checked').each(function(){
            all_ids.push($(this).val());
        })
        $('#total_selected').text(all_ids.length);
    });
    $('.chk_equipment').click(function () { 
        var all_ids = [];
        $('input:checkbox[name="ids"]:checked').each(function(){
            all_ids.push($(this).val());
        })
        $('#total_selected').text(all_ids.length);
    });
        // ==================================================
    // proceed to next modal
    $('#next_modal_1').click(function () { 
        $('input:checkbox[name="ids"]:checked').each(function(){
            equipment_selected.push($(this).val());
        })
        
        if(equipment_selected.length == 0){
            swal({
                text: "0 property selected, select at least 1...",
            });
        }else{  
            max_length = equipment_selected.length;
            $('#equipmentModal').modal('hide');
            // $('#selectModal').modal('hide');
            // $('#maintenanceModal').modal('show');
            
            // var jsonString = JSON.parse(JSON.stringify(all_ids));
            // console.log(jsonString);
            $('#requestModal').modal('show');
        }
    });
    // saving request to database
    $('#btn_submit').click(function (e) { 
        e.preventDefault();
        $(this).text('Submitting...');

        data = {
            'effective_date' : $('#effective_date').val(),
            'date_of_request' : $('#date_of_request').val(),
            'office' : $('#office').val(),
            'units' : $('#units').val(),
            'nature_of_request' : $('#nature_of_request').val(),
            'replaced_parts' : $('#replaced_parts').val(),
            'amount_of_replaced_parts' : $('#amount_of_replaced_parts').val(),
            'status' : $('#status').val(),
            'requested_by' : $('#requested_by').val(),
            'assigned_personnel' : $('#technical_personnel').val(),
            'date_received' : $('#date_received').val(),
            'findings' : $('#findings').val(),
            'action_taken' : $('#action_taken').val(),
            'recommending_for' : $('#recommending_for').val(),
            'date_returned_by' : $('#date_returned_by').val(),
            'accepted_by' : $('#accepted_by').val(),
        }

        $.ajax({
            type: "POST",
            url: "/admin/properties/request/store",
            data: data,
            dataType: "json",
            success: function (response) {
                if( response.status == 400 ){
                    console.log(response.errors);
                    swal({
                        text: 'Something went wrong...',
                    });
                }else if(response.status == 200){
                    var data = {
                        'request_id' : response.id,
                    }
                    // ajax for updating the equipment request
                    equipment_selected.forEach(function(item, index){
                        var selected = item.split(',');
                        if(selected[1]=='e'){
                            // ajax for updating equipment request
                            $.ajax({
                                type: "PUT",
                                url: "/admin/properties/requests/add_requests_to_equipment/"+parseInt(selected[0]),
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    if(response.status == 404){
                                        console.log('not ok');
                                    }else if(response.status == 200){
                                        console.log('ok');
                                    }else{
                                        console.log('not ok');
                                    }
                                }
                            });
                            // end of ajax function
                        }else if(selected[1] == 'v'){
                             // ajax for updating vehicles request
                             $.ajax({
                                type: "PUT",
                                url: "/admin/properties/requests/add_requests_to_vehicles/"+parseInt(selected[0]),
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    if(response.status == 404){
                                        console.log('not ok');
                                    }else if(response.status == 200){
                                        console.log('ok');
                                    }else{
                                        console.log('not ok');
                                    }
                                }
                            });
                            // end of ajax function
                        }
                        if(index+1 == max_length){ 
                            $('#btn_submit').text('Submit');
                            swal({
                                text: 'Request Added Successfully...',
                            });
                        }
                    })
                    $('#requestModal').modal('hide');
                }else{
                    swal({
                        text: response.message,
                    });
                }
                $('#btn_submit').text('Submit');
                $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });
    // fetching data and transfer to modal
        // =========================================================
    // fetching data to edit modal form
    $(document).on('click', '.btn_edit', function (e) {
        e.preventDefault();
        $(this).text('Fetching Data...');
        var request_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/requests/edit/"+request_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{

                    $('#edit_id').val(response.request.id);
                    $('#edit_effective_date').val(response.request.effective_date);
                    $('#edit_date_of_request').val(response.request.date_of_request);
                    $('#edit_office').val(response.request.office);
                    $('#edit_units').val(response.request.quantity);
                    $('#edit_nature_of_request').val(response.request.nature_of_request);
                    $('#edit_replaced_parts').val(response.request.replaced_parts);
                    $('#edit_amount_of_replaced_parts').val(response.request.amount_of_replaced_parts);
                    $('#edit_status').val(response.request.status);
                    $('#edit_requested_by').val(response.request.requested_by);
                    $('#edit_technical_personnel').val(response.request.assigned_personnel);
                    $('#edit_date_received').val(response.request.date_received);
                    $('#edit_findings').val(response.request.findings);
                    $('#edit_action_taken').val(response.request.action_taken);
                    $('#edit_recommending_for').val(response.request.recommending_for);
                    $('#edit_date_returned_by').val(response.request.date_returned_by);
                    $('#edit_accepted_by').val(response.request.accepted_by);
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
        var request_id = $('#edit_id').val();
        var data = {
            'effective_date' : $('#edit_effective_date').val(),
            'date_of_request' : $('#edit_date_of_request').val(),
            'office' : $('#edit_office').val(),
            'units' : $('#edit_units').val(),
            'nature_of_request' : $('#edit_nature_of_request').val(),
            'replaced_parts' : $('#edit_replaced_parts').val(),
            'amount_of_replaced_parts' : $('#edit_amount_of_replaced_parts').val(),
            'status' : $('#edit_status').val(),
            'requested_by' : $('#edit_requested_by').val(),
            'assigned_personnel' : $('#edit_technical_personnel').val(),
            'date_received' : $('#edit_date_received').val(),
            'findings' : $('#edit_findings').val(),
            'action_taken' : $('#edit_action_taken').val(),
            'recommending_for' : $('#edit_recommending_for').val(),
            'date_returned_by' : $('#edit_date_returned_by').val(),
            'accepted_by' : $('#edit_accepted_by').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/requests/edit/save/"+request_id,
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
        var request_id = $(this).val();

        $('#delete_id').val(request_id);
        $('#deleteModal').modal('show');
    });
        // Confirmed delete data
        $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var request_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/requests/delete/confirm/"+request_id,
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
