@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Articles</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Articles</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Articles</th>
                    <th>Account Code</th>
                    <th>Account Title</th>
                    <th>Account Type</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td>
                    </td> --}}
                    {{-- <td>
                        <select data-column="1" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="Row 1 Data a0">Row 1 Data a0</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="2" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="3" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="3" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td> --}}
                {{-- </tr>
            </tfoot> --}}
        </table>
    </div>

    <!-- =============================================================== -->
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Articles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="account_code">Account Code:</label>
                                <input type="text" class="form-control" id="account_code" name="account_code" required>
                            </div>
                            <div class="col">
                                <label for="account_title">Account Title:</label>
                                <input type="text" class="form-control" id="account_title" name="account_title" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                                <div class="col">
                                    <label for="account_type">Account type:</label>
                                    <select class="form-select" id="account_type" name="account_type" aria-label="Default select example" required>
                                        <option selected>- Select Account types -</option>
                                        <option value="Type 1">Type 1</option>
                                        <option value="Type 2">Type 2</option>
                                        <option value="Type 3">Type 3</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="article">Article:</label>
                                    <input type="text" class="form-control" id="article" name="article" required>    
                                </div>
                            </div>
                            <!-- end of input group -->
                            <!-- input group -->
                            <div class="row">
                                <div class="col">
                                    <label for="article_for">Article for:</label>
                                    <select class="form-select" id="article_for" name="article_for" required>
                                        <option selected>- Select -</option>
                                        <option value="Equipment">Equipment</option>
                                        <option value="Vehicles">Vehicles</option>
                                    </select>
                                </div>
                                <div class="col">  
                                </div>
                            </div>
                            <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn_submit">Submit</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Add Modal -->
        <!-- =============================================================== -->
    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Articles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                <input type="hidden" id="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_account_code">Account Code:</label>
                                <input type="text" class="form-control" id="edit_account_code" name="edit_account_code" required>
                            </div>
                            <div class="col">
                                <label for="edit_account_title">Account Title:</label>
                                <input type="text" class="form-control" id="edit_account_title" name="edit_account_title" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                                <div class="col">
                                    <label for="edit_account_type">Account type:</label>
                                    <select class="form-select" id="edit_account_type" name="edit_account_type" aria-label="Default select example" required>
                                        <option selected>- Select Account types -</option>
                                        <option value="Type 1">Type 1</option>
                                        <option value="Type 2">Type 2</option>
                                        <option value="Type 3">Type 3</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="edit_article">Articles:</label>
                                    <input type="text" class="form-control" id="edit_article" name="edit_article" required>
                                </div>
                            </div>
                            <!-- end of input group -->
                                <!-- input group -->
                                <div class="row">
                                    <div class="col">
                                        <label for="edit_article_for">Article for:</label>
                                        <select class="form-select" id="edit_article_for" name="edit_article_for" required>
                                            <option selected>- Select -</option>
                                            <option value="Equipment">Equipment</option>
                                            <option value="Vehicles">Vehicles</option>
                                        </select>
                                    </div>
                                    <div class="col">  
                                    </div>
                                </div>
                                <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn_update" id="update_btn">Update</button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    <!-- End of Add Modal -->
    {{-- ============================================================= --}}
    {{-- Delete Confirmation Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
            <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="delete_id">
            Are your sure you want to delete this record?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary delete_btn">Yes Delete</button>
            </div>
        </div>
        </div>
    </div>
    {{-- end of delete modal --}}
@include('layouts.footer')
@endsection

@section('scripts')
<script src="/js/articles.js"></script>
<script>
    //datata ajax
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       paging: true,
       ajax: "{{ route('get.articles.list') }}",
       columns: [
           // {data : "DT_RowIndex", name : "DT_RowIndex"},
           {
               data: 'id',
               name: 'action',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return '<span><button value="'+data+'" class="btn btn-danger btn_delete">Delete</button></span>  <span> <button type="button" value="'+data+'" class="btn btn_edit btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button></span>'
               }
           },
           { data : "article", name: "article" },
           { data : "account_code", name: "account_code" },
           { data : "account_title", name: "account_title" },
           { data : "account_type", name: "account_type" },
       ],
       dom: 'Bfrtip',
       buttons: [
           'colvis',
           'excel',
           'print'
       ],
       scrollY: "400px",
       scrollX: true,
       scrollCollapse: true,
       fixedColumns: true,
       iDisplayLength: 25,
   })
</script>
@endsection