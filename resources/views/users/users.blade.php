@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Users</h3>
        <div class="buttons">
            <div></div>
            {{-- <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add User</button>          --}}
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Office/Department</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select data-column="1" class="form-control filter-select">
                            <option value="">Select</option>
                            @foreach( $users_first_name as $first_name )
                                <option value="{{ $first_name->first_name }}">{{ $first_name->first_name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="3" class="form-control filter-select">
                            <option value="">Select</option>
                            @foreach( $users_last_name as $last_name )
                                <option value="{{ $last_name->last_name }}">{{ $last_name->last_name }}</option>
                             @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="7" class="form-control filter-select">
                        <option value="">Select</option>
                        @foreach( $offices as $office )
                            <option value="{{ $office->office_name }}">{{ $office->office_name }}</option>
                        @endforeach
                        </select>
                    </td>
                    <td>
                    </td>

                </tr>
            </tfoot>
        </table>
    </div>

    <!-- =============================================================== -->
    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="" method="POST">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="article">FIrst Name:*</label>
                                <input type="text" class="form-control" name="article"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="requisitioner">Middle Name(if any):</label>
                                <input type="text" class="form-control" name="article"  aria-label="First name">
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="deployment">Last Name:*</label>
                                <input type="text" class="form-control" name="article"  aria-label="First name">
                            </div>
                            <div class="col">
                                <label for="property_number">Email:*</label>
                                <input type="email" class="form-control" name="property_number"  aria-label="Last name" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="account_code">Contact Number:*</label>
                                <input type="number" class="form-control" name="account_code"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="remarks">Office/Department:*</label>
                                <select class="form-select" aria-label="Default select example" required>
                                    <option selected>- Select Remarks -</option>
                                    <option value="1">Institute of Computer Studies</option>
                                    <option value="2">Computer Engineering</option>
                                    <option value="3">College of Nursing</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="units">Address:*</label>
                                <input type="text" class="form-control" name="units"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="remarks">User Role:*</label>
                                <select class="form-select" aria-label="Default select example" required>
                                    <option selected>- Select Role -</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Admin Aide</option>
                                    <option value="3">User</option>
                                    <option value="">Technical Personnel</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                @csrf
                 {{-- hidden input for user id --}}
                 <input type="hidden" id="edit_id" name="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_first_name">FIrst Name:*</label>
                                <input type="text" class="form-control" id="edit_first_name" name="edit_first_name"  aria-label="First name" disabled>
                            </div>
                            <div class="col">
                                <label for="edit_middle_name">Middle Name(if any):</label>
                                <input type="text" class="form-control" id="edit_middle_name" name="edit_middle_name"  aria-label="First name" disabled>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_last_name">Last Name:*</label>
                                <input type="text" class="form-control" name="edit_last_name" id="edit_last_name"  aria-label="First name" disabled>
                            </div>
                            <div class="col">
                                <label for="email">Email:*</label>
                                <input type="email" class="form-control" name="edit_email" id="edit_email" aria-label="Last name" disabled>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_contact_number">Contact Number:*</label>
                                <input type="number" class="form-control" name="edit_contact_number" id="edit_contact_number"  aria-label="First name" disabled>
                            </div>
                            <div class="col">
                                <label for="edit_office">Office/Department:*</label>
                                <select class="form-select" name="edit_office" id="edit_office" aria-label="Default select example" required>
                                    <option selected>- Select -</option>
                                    @foreach( $offices as $office)
                                       <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_address">Address:*</label>
                                <input type="text" class="form-control" name="edit_address" id="edit_address"  aria-label="First name" disabled>
                            </div>
                            <div class="col">
                                <label for="role">Role:</label>
                                <select class="form-select" id="edit_role" name="edit_role" aria-label="Default select example" required>
                                    <option selected>- Select Role -</option>
                                    <option value="admin">Admin</option>
                                    <option value="admin aide">Admin Aide</option>
                                    <option value="user">User</option>
                                    <option value="techincal personnel">Technical Personnel</option>
                                </select>
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
@endsection

@section('scripts')
<script src="/js/users.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.users.list') }}",
       columns: [
           // {data : "DT_RowIndex", name : "DT_RowIndex"},
           {
               data: 'id',
               name: 'action',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return '<span><button value="'+data+'" class="btn btn-danger btn_delete">Delete</button></span>  <span> <button type="button" value="'+data+'" class="btn edit_btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</button></span>'
               }
           },
           { data : "first_name", name: "first_name" },
           { data : "middle_name", name: "middle_name" },
           { data : "last_name", name: "last_name" },
           { data : "contact_number", name: "contact_number" },
           { data : "email", name: "email" },
           { data : "role", name: "role" },
           { data : "office_name", name: "office_name" },
           { data : "address", name: "address" }
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