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
});
