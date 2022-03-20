@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Land Improvements</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Land Improvement</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Name of Project</th>
                    <th>Location</th>
                    <th>Project Cost</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td>
                    </td>
                    <td>
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
                </tr>
            </tfoot> --}}
        </table>
    </div>

    <!-- =============================================================== -->
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Land Improvement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="name_of_project">Name of Project:</label>
                                <input type="text" class="form-control" name="name_of_project" id="name_of_project" required>
                            </div>
                            <div class="col">
                                <label for="location">Location:</label>
                                <input type="text" nmae="location" id="location" class="form-control">
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="project_cost">Project Cost:</label>
                                <div class="input-group">
                                    <div class="input-group-text">₱</div>
                                    <input type="number" class="form-control" id="project_cost" name="project_cost" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_submit">Submit</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Update Land Improvement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                <input type="hidden" id="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_name_of_project">Name of Project:</label>
                                <input type="text" class="form-control" name="edit_name_of_project" id="edit_name_of_project" required>
                            </div>
                            <div class="col">
                                <label for="edit_location">Location:</label>
                                <input type="text" nmae="edit_location" id="edit_location" class="form-control">
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_project_cost">Project Cost:</label>
                                <div class="input-group">
                                    <div class="input-group-text">₱</div>
                                    <input type="number" class="form-control" id="edit_project_cost" name="edit_project_cost" placeholder="0.0" required>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
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
<script src="/js/landimprovements.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.landimprovements.list') }}",
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
           { data : "name_of_project", name: "name_of_project" },
           { data : "location", name: "location" },
           {
                data: 'project_cost',
                name: 'project_cost',
                orderable: true,
                searchable: true,
                "render": function (data, type, row, meta){
                    return '₱'+parseInt(data).toLocaleString()
                }
            },
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