@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Buildings</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Building</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>ACTIONS</th>
                    <th>NAME OF BUILDING</th>
                    <th>AREA AQUIRED BY BLDG.</th>
                    <th>LOCATION/ADDRESS</th>
                    <th>MAKE</th>
                    <th>NO. OF FLOORS</th>
                    <th>TOTAL FLOOR AREA</th>
                    <th>APPEARANCE/CONDITION</th>
                    <th>CURRENT USE</th>
                    <th>NO. OF RMS</th>
                    <th>DATE CONSTRUCTED ACQUIRED</th>
                    <th>HOW ACQUIRED</th>
                    <th>COST OF CONSTRUCTION ACQUISITION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <h6>FILTER BY:</h6>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="3" class="form-control border-secondary filter-select">
                            <option value="">Location</option>
                            @foreach($distinct_locations as $location)
                            <option value="{{ $location->location }}">{{ $location->location }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select data-column="4" class="form-control border-secondary filter-select">
                            <option value="">Make</option>
                            <option value="Concrete">Concrete</option>
                            <option value="Glass">Glass</option>
                            <option value="Bricks">Bricks</option>
                            <option value="Stone">Stone</option>
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="7" class="form-control border-secondary filter-select">
                            <option value="">Appearance</option>
                            <option value="Serviceable">Serviceable</option>
                            <option value="Not Serviceable">Not Serviceable</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="8" class="form-control border-secondary filter-select">
                            <option value="">Current use</option>
                            <option value="Classes">Classes</option>
                            <option value="Various">Various</option>
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="11" class="form-control border-secondary filter-select">
                            <option value="">How acquired</option>
                            @foreach($distinct_how_acquired as $how_acquired)
                            <option value="{{ $how_acquired->how_acquired }}">{{ $how_acquired->how_acquired }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Building</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="name_of_building">Name of Building:</label>
                            <input type="text" class="form-control" name="name_of_building" id="name_of_building"  aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="area_acquired">Area Aquired by bldg:</label>
                            <input type="number" name="area_acquired" id="area_acquired" class="form-control">
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="location">Location/Address:</label>
                            <input type="text" id="location" name="location" class="form-control">
                        </div>
                        <div class="col">
                            <label for="make">Make:</label>
                            <select class="form-select" id="make" name="make" aria-label="Default select example" required>
                                <option selected>- Select Make -</option>
                                <option value="Concrete">Concrete</option>
                                <option value="Glass">Glass</option>
                                <option value="Bricks">Bricks</option>
                                <option value="Stone">Stone</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="number_of_floors">Number of Floors:</label>
                            <input type="number" class="form-control" name="number_of_floors" id="number_of_floors"  aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="total_floor_area">Total Floor Area:</label>
                            <input type="number" class="form-control" name="total_floor_area" id="total_floor_area" placeholder="0.0" disabled>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="condition">Appearance/Condition:</label>
                            <select class="form-select" id="condition" name="condition" aria-label="Default select example" required>
                                <option selected>- Select Appearance/Condtion -</option>
                                <option value="Serviceable">Serviceable</option>
                                <option value="Not Serviceable">Not Serviceable</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="current_use">Current Use:</label>
                            <select class="form-select" id="current_use" name="current_use" aria-label="Default select example" required>
                                <option selected>- Select Current Use-</option>
                                <option value="Classes">Classes</option>
                                <option value="Various">Various</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                      <!-- input group -->
                      <div class="row">
                        <div class="col">
                            <label for="num_of_rooms">Number of Rooms:</label>
                            <input type="number" class="form-control" name="num_of_rooms" id="num_of_rooms"  aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="date_constructed">Date Constructed Aquired</label>
                            <input type="date" class="form-control" name="date_constructed" id="date_constructed">
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="how_acquired">How Aquired:</label>
                            <select class="form-select" name="how_acquired" id="how_acquired" aria-label="Default select example" required>
                                <option selected>- Select How Aquired-</option>
                                <option value="National">National</option>
                                <option value="STF">STF</option>
                            </select>
                        </div>
                        <div class="col">
                        <label for="cost">Cost of Construction Aqusition:</label>
                            <div class="input-group">
                                <div class="input-group-text">₱</div>
                                <input type="number" class="form-control" id="cost" name="cost" placeholder="0.0" required>
                            </div>
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
                <h5 class="modal-title" id="updateModalLabel">Update Building</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                  <input type="text" id="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_name_of_building">Name of Building:</label>
                                <input type="text" class="form-control" name="edit_name_of_building" id="edit_name_of_building"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="edit_area_acquired">Area Aquired by bldg:</label>
                                <input type="number" name="edit_area_acquired" id="edit_area_acquired" class="form-control">
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_location">Location/Address:</label>
                                <input type="text" id="edit_location" name="edit_location" class="form-control">
                            </div>
                            <div class="col">
                                <label for="edit_make">Make:</label>
                                <select class="form-select" id="edit_make" name="edit_make" aria-label="Default select example" required>
                                    <option selected>- Select Make -</option>
                                    <option value="Concrete">Concrete</option>
                                    <option value="Glass">Glass</option>
                                    <option value="Bricks">Bricks</option>
                                    <option value="Stone">Stone</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_number_of_floors">Number of Floors:</label>
                                <input type="number" class="form-control" name="edit_number_of_floors" id="edit_number_of_floors"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="edit_total_floor_area">Total Floor Area:</label>
                                <input type="number" class="form-control" name="edit_total_floor_area" id="edit_total_floor_area" placeholder="0.0" disabled>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_condition">Appearance/Condition:</label>
                                <select class="form-select" id="edit_condition" name="edit_condition" aria-label="Default select example" required>
                                    <option selected>- Select Appearance/Condtion -</option>
                                    <option value="Serviceable">Serviceable</option>
                                    <option value="Not Serviceable">Not Serviceable</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="edit_current_use">Current Use:</label>
                                <select class="form-select" id="edit_current_use" name="edit_current_use" aria-label="Default select example" required>
                                    <option selected>- Select Current Use-</option>
                                    <option value="Classes">Classes</option>
                                    <option value="Various">Various</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                          <!-- input group -->
                          <div class="row">
                            <div class="col">
                                <label for="edit_num_of_rooms">Number of Rooms:</label>
                                <input type="number" class="form-control" name="edit_num_of_rooms" id="edit_num_of_rooms"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="edit_date_constructed">Date Constructed Aquired</label>
                                <input type="date" class="form-control" name="edit_date_constructed" id="edit_date_constructed">
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_how_acquired">How Aquired:</label>
                                <select class="form-select" name="edit_how_acquired" id="edit_how_acquired" aria-label="Default select example" required>
                                    <option selected>- Select How Aquired-</option>
                                    <option value="National">National</option>
                                    <option value="STF">STF</option>
                                </select>
                            </div>
                            <div class="col">
                            <label for="edit_cost">Cost of Construction Aqusition:</label>
                                <div class="input-group">
                                    <div class="input-group-text">₱</div>
                                    <input type="number" class="form-control" id="edit_cost" name="edit_cost" placeholder="0.0" required>
                                </div>
                            </div>
                        </div>
                        <!-- end of input group -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_update">Update</button>
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
<script src="/js/buildings.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.buildings.list') }}",
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
           { data : "name_of_building", name: "name_of_building" },
           {
                data: 'area_acquired',
                name: 'area_acquired',
                orderable: true,
                searchable: true,
                "render": function (data, type, row, meta){
                    return parseInt(data).toLocaleString()
                }
            },
           { data : "location", name: "location" },
           { data : "make", name: "make" },
           { data : "num_of_floors", name: "num_of_floors" },
           {
                data: 'total_floor_area',
                name: 'total_floor_area',
                orderable: true,
                searchable: true,
                "render": function (data, type, row, meta){
                    return parseInt(data).toLocaleString()
                }
            },
           { data : "condition", name: "condition" },
           { data : "current_use", name: "current_use" },
           { data : "num_of_rooms", name: "num_of_rooms" },
           { data : "date_constructed", name: "date_constructed" },
           { data : "how_acquired", name: "how_acquired" },
           {
                data: 'cost',
                name: 'cost',
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