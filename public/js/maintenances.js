$(document).ready( function () {
    let type = '';
    // Filter Maintenance table
    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });
    // ===============================================
    // adding new maintenance schedule
    $(document).on('click', '#btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'date_start' : $('#date_end').val(),
            'location' : $('#location').val(),
            'project_cost' : $('#project_cost').val(),
        }
        
        $.ajax({
            type: "POST",
            url: "/admin/properties/landimprovements/store",
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
                    $('#exampleModal').modal('hide');
                }else{
                    swal({
                        text: response.message,
                    });
                }
                $('.btn_submit').text('Submit');
                $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });
});
