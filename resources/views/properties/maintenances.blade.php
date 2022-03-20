@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Maintenances Schedules</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#maintenanceModal">Add Maintenance Schedule</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Article</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>No. of Worlking Days</th>
                    <th>Office/College</th>
                    <th>No. of Units</th>
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
                        <select data-column="4" class="form-control filter-select">
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
    <div class="modal fade" id="maintenanceModal" tabindex="-1" aria-labelledby="maintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="maintenanceModalLabel">Add Maintenance Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="date_start">Date Start:</label>
                            <input type="date" class="form-control border-secondary" name="date_start"  id="date_start" required>
                        </div>
                        <div class="col">
                            <label for="date_end">Date End:</label>
                            <input type="date" class="form-control border-secondary" name="date_end" id="date_end" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="working_days">No. of Workig Days:</label>
                            <input type="number" class="form-control border-secondary" name="working_days" id="working_days" disabled required>
                        </div>
                        <div class="col">
                            <label for="office">Office/College:</label>
                            <select class="form-select border-secondary" id='office' name="office" required>
                                <option value="NULL" selected>- Select -</option>
                                @foreach ($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="units">No. of Units</label>
                            <input type="number" class="form-control border-secondary" name="units" id="units" required>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Maintenance Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="asdf">Date Start:</label>
                            <input type="date" class="form-control" name="adsf" id="adsf" required>
                        </div>
                        <div class="col">
                            <label for="adf">Date End:</label>
                            <input type="date" class="form-control" name="adsf" id="adf" aria-label="First name" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="adsf">No. of Workig Days:</label>
                            <input type="number" class="form-control" name="adfs" id="adfs" required>
                        </div>
                        <div class="col">
                            <label for="sadf">Office/College:</label>
                            <select class="form-select" name="adf" id="adf" required>
                                <option selected>- Select -</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="adf">No. of Units</label>
                            <input type="number" class="form-control" name="adf" id="adf" required>
                        </div>
                        <div class="col">
                            <label for="account_code">Equipment</label>
                             <select class="form-select" aria-label="Default select example" required>
                                <option selected>- Select -</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
          </form>
        </div>
    </div>
    </div>
    <!-- End of Update Modal -->
    <!-- =============================================================== -->
    <!-- View Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="viewModalLabel">View Maintenance Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <h5>Equipment Details</h5>
                <div class="row">
                    <div class="col">
                        <p><b>Airconditioner</b></p>
                        <p>Description: Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi, consequuntur!</p>
                        <p>Number of Units for Maintenance: 5</p>
                    </div>
                    <div class="col">
                    <form action="">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="article">Date Start:</label>
                                <input type="date" class="form-control" name="article"  aria-label="First name" required disabled>
                            </div>
                            <div class="col">
                                <label for="requisitioner">Date End:</label>
                                <input type="date" class="form-control" name="article"  aria-label="First name" required disabled>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="deployment">No. of Workig Days:</label>
                                <input type="number" class="form-control" name="article"  aria-label="First name" required disabled>
                            </div>
                            <div class="col">
                                <label for="property_number">Office/College:</label>
                                <select class="form-select" aria-label="Default select example" required disabled>
                                    <option selected>- Select -</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="account_code">No. of Units</label>
                                <input type="number" class="form-control" name="account_code"  aria-label="First name" required disabled>
                            </div>
                            <div class="col">
                                <label for="account_code">Equipment</label>
                                <select class="form-select" aria-label="Default select example" required disabled>
                                    <option selected>- Select -</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                    </div>
                </div>
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
@include('layouts.footer')
@endsection

@section('scripts')
<script src="/js/maintenances.js"></script>
{{-- <script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.maintenances.list') }}",
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
</script> --}}
@endsection