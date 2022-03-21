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
                    swal({
                        text: response.message
                    });
                    // ajax for updating the equipment request
                    equipment_selected.forEach(function(item, index){
                        var selected = item.split(',');
                        if(selected[1]=='e'){
                            // ajax for updating equipment request
                            $.ajax({
                                type: "PUT",
                                url: "/admin/properties/requests/add_requests_to_equipment/"+item,
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    if(response.status == 404){
                                        swal({
                                            text: "Something went wrong..."
                                        });
                                    }
                                }
                            });
                            // end of ajax function
                        }else if(selected[1] == 'v'){
                             // ajax for updating equipment request
                             $.ajax({
                                type: "PUT",
                                url: "/admin/properties/requests/add_requests_to_items/"+item,
                                data: data,
                                dataType: "json",
                                success: function (response) {
                                    if(response.status == 404){
                                        swal({
                                            text: "Something went wrong..."
                                        });
                                    }
                                }
                            });
                            // end of ajax function
                        }
                        // if(index+1 == max){ 
                        //     $('#btn_submit').text('Submit');
                        //     swal({
                        //         text: 'Maintenance Schedule Added Successfully...',
                        //     });
                        // }
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
});
