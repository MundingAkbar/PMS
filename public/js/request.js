$(document).ready( function () {
    var table = $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'colvis',
            'excel',
            'print'
        ],
        scrollY: "400px",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [
            { width: '20%', targets: 4 }
        ],
        fixedColumns: true,
        iDisplayLength: 25,
    })

    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
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
            // $('#selectModal').modal('hide');
            // $('#maintenanceModal').modal('show');
            $('#total_selected').text(all_ids.length);
            var jsonString = JSON.parse(JSON.stringify(all_ids));
            console.log(jsonString);
            $('#requestModal').modal('show');

            // fetching all selected data to next modal
            $.ajax({
                type: "POST",
                url: "/admin/request/make_request",
                data: "data",
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
        }
    });
});
