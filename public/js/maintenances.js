$(document).ready( function () {
    let type = '';
    // Filter Maintenance table
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
  
});
