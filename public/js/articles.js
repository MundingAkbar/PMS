
$(document).ready( function () {

    $('.filter-select').change(function(){
        table.column( $(this).data('column'))
            .search( $(this).val() )
            .draw();
    });

     // ===============================================
    // adding new office/department
    $(document).on('click', '.btn_submit', function (e) {
        e.preventDefault();
        $(this).text('Submitting...');
        var data = {
            'account_code' : $('#account_code').val(),
            'account_title' : $('#account_title').val(),
            'account_type' : $('#account_type').val(),
            'article' : $('#article').val(),
            'article_for' : $('#article_for').val()
        }
        
        $.ajax({
            type: "POST",
            url: "/admin/properties/articles/store",
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
    // =========================================================
    // fetching data to edit modal form
    $(document).on('click', '.btn_edit', function (e) {
        e.preventDefault();
        $(this).text('Fetching Data...');
        var article_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "/admin/properties/articles/edit/"+article_id,
            success: function (response) {
                if(response.status == 404){
                    swal({
                        text: response.message,
                    });
                }else{
                    $('#edit_id').val(response.article.id);
                    $('#edit_account_code').val(response.article.account_code);
                    $('#edit_account_title').val(response.article.account_title);
                    $('#edit_article').val(response.article.article);
                    $('#edit_account_type').val(response.article.account_type);
                    $('#edit_article_for').val(response.article.article_for);
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
        var article_id = $('#edit_id').val();
        var data = {
            'account_code': $('#edit_account_code').val(),
            'account_title': $('#edit_account_title').val(),
            'account_type': $('#edit_account_type').val(),
            'article': $('#edit_article').val(),
            'article_for': $('#edit_article_for').val(),
        };

        $.ajax({
            type: "PUT",
            url: "/admin/properties/articles/edit/save/"+article_id,
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
        var article_id = $(this).val();

        $('#delete_id').val(article_id);
        $('#deleteModal').modal('show');
    });
      // Confirmed delete data
      $(document).on('click','.delete_btn', function (e) {
        e.preventDefault();

        var article_id = $('#delete_id').val();
        $(this).text('Deleting...');

        $.ajax({
            type: "DELETE",
            url: "/admin/properties/articles/delete/confirm/"+article_id,
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