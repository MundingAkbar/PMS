@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Offices/Department</h3>
        <div class="buttons">
            <div></div>
            {{-- <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button> --}}
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Office/Department</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Office/Department Name</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <!-- =============================================================== -->
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Office</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                    @csrf
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="office_name">Office/Department Name:</label>
                                <input type="text" class="form-control" name="office_name" id="office_name"  aria-label="First name" required>
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
                    <h5 class="modal-title" id="updateModalLabel">Update Office</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="">
                    @csrf
                        {{-- hidden office id --}}
                        <input type="hidden" id="edit_id">
                        <!-- input group -->
                            <div class="row">
                                <div class="col">
                                    <label for="edit_office_name">Office/Department Name:</label>
                                    <input type="text" class="form-control" name="edit_office_name" id="edit_office_name"  aria-label="First name" required>
                                </div>
                            </div>
                            <!-- end of input group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="update_btn" class="btn btn-primary">Update</button>
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
<script src="/js/offices.js"></script>
<script>
     //datatable ajax 
     var table = $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.offices.list') }}",
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
            { data : "office_name", name: "office_name" },
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