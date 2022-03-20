$(document).ready( function () {
    let type = '';
    // Filter Maintenance table
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    // ================================================
    // Checking type of maintenance clicks
    $(document).on('click','#showEquipment', function () {
        $('#equipmentModal').modal('show');
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        type = 'equipment';
    });
    // $(document).on('click','#showVehicles', function () {
    //     $('#equipmentModal').modal('show');
    //     $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    //     type = 'equipment';
    // });
    // $(document).on('click','#showBuildings', function () {
    //     $('#equipmentModal').modal('show');
    //     $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    //     type = 'equipment';
    // });
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
    // ==================================================
    // proceed to next modal
    $('#next_modal_1').click(function () { 
        var all_ids = [];
        $('input:checkbox[name="ids"]:checked').each(function(){
            all_ids.push($(this).val());
        })
        
        if(all_ids.length == 0){
            swal({
                text: "0 property selected, select at least 1...",
            });
        }else{
            $('#equipmentModal').modal('hide');
            $('#selectModal').modal('hide');
            $('#maintenanceModal').modal('show');
        }
    });
    // ================================================
    // submit the schedule
    $(document).on('click','#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        if(type == 'equipment'){
            var all_ids = [];

            $('input:checkbox[name="ids"]:checked').each(function(){
                all_ids.push($(this).val());
            })

            var data = {
                'date_start' : $('#date_start').val(),
                'date_end' : $('#date_end').val(),
                'working_days' : $('#working_days').val(),
                'office' : $('#office').val(),
                'units' : $('#units').val(),
            }
            // getting the max length of array
            let max = all_ids.length;
            console.log(max);
            // save the schedule to database
            $.ajax({
                type: "POST",
                url: "/admin/properties/maintenances/store",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 404){
                        swal({
                            text: "Something went wrong..."
                        });
                    }else if(response.status == 500){
                        swal({
                            text: "Something went wrong when saving data..."
                        });
                    }
                    // loop the array and update all of the maintenance fields
                    // create a route for doing that
                    // fetch the id of the latest maintenance first and store to json
                    var data = {
                        'maintenance_id' : response,
                    }
                    all_ids.forEach(function(item, index){
                        $.ajax({
                            type: "PUT",
                            url: "/admin/properties/maintenances/equipments/add_sched/"+item,
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

                        if(index+1 == max){ 
                            $('#btn_submit').text('Submit');
                            swal({
                                text: 'Maintenance Schedule Added Successfully...',
                            });
                        }
                    })
                }
            });
            // ======================================================

        }else if(type == 'vehicles'){

        }else if(type == 'buildings'){

        } 
    });
});
