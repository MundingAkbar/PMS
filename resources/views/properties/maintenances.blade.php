@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Maintenances Schedules</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#selectModal">Add Maintenance Schedule</button>         
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
    <!-- Maintenance type Modal -->
    <div class="modal fade" id="selectModal" tabindex="-1" aria-labelledby="selectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectModalLabel">Choose Maintenance Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    {{-- data-bs-toggle="modal" data-bs-target="#equipmentModal" --}}
                    <button type="button" id="showEquipment" class="btn btn-dark btn-lg m-2">Equipment</button>
                    <button type="button" class="btn btn-dark btn-lg m-2">Vehicles</button>
                    <button type="button" class="btn btn-dark btn-lg m-2">Buildings</button>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- End of Maintenance type Modal -->
    <!-- =============================================================== -->
    <!-- Vehicles Maintenance Modal -->
    <div class="modal fade" id="vehiclesModal" tabindex="-1" aria-labelledby="vehiclesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vehiclesModalLabel">Select Vehicles Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="article">Date Start:</label>
                                <input type="date" class="form-control border-secondary" name="article"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="requisitioner">Date End:</label>
                                <input type="date" class="form-control border-secondary" name="article"  aria-label="First name" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="deployment">No. of Workig Days:</label>
                                <input type="number" class="form-control border-secondary" name="article"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="property_number">Office/College:</label>
                                <select class="form-select border-secondary" aria-label="Default select example" required>
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
                                <input type="number" class="form-control border-secondary" name="account_code"  aria-label="First name" required>
                            </div>
                            <div class="col">
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
    <!-- Select Equipments Modal -->
    <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equipmentModalLabel">Select Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             {{-- equipment table --}}
             <table id="equipmentTable" class="stripe row-border order-column" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            <div class="row justify-content-center">
                                <input type="checkbox" class="form-check-input border-dark" name="check_all_equipment" id="check_all_equipment">
                            </div>
                        </th>
                        <th>Article</th>
                        <th>Deployment</th>
                        <th>Requisitioner</th>
                        <th>Property Number</th>
                        <th>Account Code</th>
                        <th>Units</th>
                        <th>Unit Value</th>
                        <th>Total Value</th>
                        <th>Remarks</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $equipment as $e)
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                <input type="checkbox" class="form-check-input chk_equipment border-dark" name="ids" id="ids" value="{{ $e->id }}">
                            </div>
                        </td>
                        <td>{{ $e->article_name }}</td>
                        <td>{{ $e->office_name }}</td>
                        <td>{{ $e->first_name.' '.$e->last_name }}</td>
                        <td>{{ $e->property_number }}</td>
                        <td>{{ $e->account_code }}</td>
                        <td>{{ $e->units }}</td>
                        <td>{{ $e->unit_value }}</td>
                        <td>{{ $e->total_value }}</td>
                        <td>{{ $e->remarks }}</td>
                        <td>{{ $e->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td>
                            <h6>FILTER BY:</h6>
                        </td>
                        <td>
                            <select data-column="1" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                @foreach($distinct_articles as $article)
                                <option value="{{ $article->article }}">{{ $article->article }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select data-column="2" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                @foreach( $offices as $office )
                                <option value="{{ $office->office_name }}">{{ $office->office_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select data-column="3" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                @foreach( $disctinct_users as $user)
                                  <option value="{{ $user->first_name}}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select data-column="4" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                @foreach( $distinct_property_number as $property_number )
                                <option value="{{ $property_number->property_number }}">{{ $property_number->property_number }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select data-column="5" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                @foreach( $distinct_articles_codes as $code )
                                <option value="{{ $code->account_code }}">{{ $code->account_code }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select data-column="9" class="form-control border-secondary filter-select">
                                <option value="">Select</option>
                                <option value="Usable">Usable</option>
                                <option value="Not Usable">Not Usable</option>
                            </select>
                        </td>
                        <td> 
                        </td>
    
                    </tr>
                </tfoot> --}}
            </table>
             {{-- end of equipment table --}}
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="next_modal_1">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- End of Add Modal -->
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
<script>
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
</script>
@endsection