@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Land Holdings</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Land Holding</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>LOT NUMBER</th>
                    <th>CLASSIFICATION</th>
                    <th>LOCATION</th>
                    <th>DATE ACQUIRED</th>
                    <th>HOW ACQUIRED</th>
                    <th>TITLED?</th>
                    <th>TOTAL AREA</th>
                    <th>CURRENT UTILIZATION</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="2" class="form-control border-secondary filter-select">
                            <option value="">Classification</option>
                            <option value="Educational">Educational</option>
                            <option value="Agricultural">Agricultural</option>
                            <option value="Residential">Residential</option>
                            <option value="Recreational">Recreational</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Transportation">Transportation</option>
                        </select>
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
                    </td>
                    <td>
                        <select data-column="5" class="form-control border-secondary filter-select">
                            <option value="">How acquired</option>
                            @foreach($distinct_how_acquired as $how_acquired)
                            <option value="{{ $how_acquired->how_acquired }}">{{ $how_acquired->how_acquired }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select data-column="6" class="form-control border-secondary filter-select">
                            <option value="">is titled</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="On Process">On Process</option>
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select data-column="8" class="form-control border-secondary filter-select">
                            <option value="">Current utilization</option>
                            @foreach($distinct_utilization as $utilization)
                            <option value="{{ $utilization->current_utilization }}">{{ $utilization->current_utilization }}</option>
                            @endforeach
                        </select>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Land Holding</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="lot_number">Lot Number:</label>
                            <input type="text" class="form-control" name="lot_number" id="lot_number" required>
                        </div>
                        <div class="col">
                            <label for="classification">Classification:</label>
                            <select class="form-select" id="classification" name="classification" required>
                                <option value="NULL"  selected>- Select Requisitioner -</option>
                                <option value="Educational">Educational</option>
                                <option value="Agricultural">Agricultural</option>
                                <option value="Residential">Residential</option>
                                <option value="Recreational">Recreational</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Transportation">Transportation</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" class="form-control">
                        </div>
                        <div class="col">
                            <label for="date_acquired">Date Aquired</label>
                            <input type="date" class="form-control" name="date_acquired" id="date_acquired" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="how_acquired">How Aquired</label>
                            <select class="form-select" id="how_acquired" name="how_acquired" required>
                                <option value="NULL"  selected>- Select How Aquired -</option>
                                <option value="Donation">Donation</option>
                                <option value="Provision of Sec. 6267 of R.A 5492">Provision of Sec. 6267 of R.A 5492</option>
                                <option value="Pursuant to Sec 18 of PD 1427">Pursuant to Sec 18 of PD 1427</option>
                                <option value="Presidential Proclamation #407 06/19/94">Presidential Proclamation #407 06/19/94</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="is_titled">Titled?:</label>
                            <select class="form-select" id="is_titled" name="is_titled" required>
                                <option selected>- Select Title Status -</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="On Process">On Process</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="total_area">Total Area</label>
                            <div class="input-group">
                                <input type="number" name="total_area" id="total_area" class="form-control">
                                <select class="form-control" name="area_type" id="area_type">
                                     <option value="sq.m" selected>sq.m</option>
                                     <option value="has">has</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label for="current_utilization">Current Utilization:</label>
                            <select class="form-select" name="current_utilization" id="current_utilization" required>
                                <option value="NULL"  selected>- Select -</option>
                                <option value="WMSU Main Campus (Lot I)">WMSU Main Campus (Lot I)</option>
                                <option value="WMSU Main Campus (Lot 2)">WMSU Main Campus (Lot 2)</option>
                                <option value="External Academic Campus">External Academic Campus</option>
                                <option value="Experimental Forest College of Forestry">Experimental Forest College of Forestry</option>
                                <option value="ESU">ESU</option>
                            </select>
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
                <h5 class="modal-title" id="updateModalLabel">Update Land Holding</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                  <input type="text" id="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_lot_number">Lot Number:</label>
                                <input type="text" class="form-control" name="edit_lot_number" id="edit_lot_number" required>
                            </div>
                            <div class="col">
                                <label for="edit_classification">Classification:</label>
                                <select class="form-select" id="edit_classification" name="edit_classification" required>
                                    <option value="NULL" selected>- Select Requisitioner -</option>
                                    <option value="Educational">Educational</option>
                                    <option value="Agricultural">Agricultural</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Recreational">Recreational</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Transportation">Transportation</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_location">Location:</label>
                                <input type="text" id="edit_location" name="edit_location" class="form-control">
                            </div>
                            <div class="col">
                                <label for="edit_date_acquired">Date Aquired</label>
                                <input type="date" class="form-control" name="edit_date_acquired" id="edit_date_acquired" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_how_acquired">How Aquired</label>
                                <select class="form-select" id="edit_how_acquired" name="edit_how_acquired" required>
                                    <option value="NULL"  selected>- Select How Aquired -</option>
                                    <option value="Donation">Donation</option>
                                    <option value="Provision of Sec. 6267 of R.A 5492">Provision of Sec. 6267 of R.A 5492</option>
                                    <option value="Pursuant to Sec 18 of PD 1427">Pursuant to Sec 18 of PD 1427</option>
                                    <option value="Presidential Proclamation #407 06/19/94">Presidential Proclamation #407 06/19/94</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="edit_is_titled">Titled?:</label>
                                <select class="form-select" id="edit_is_titled" name="edit_is_titled" required>
                                    <option selected>- Select Title Status -</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="On Process">On Process</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_total_area">Total Area</label>
                                <div class="input-group">
                                    <input type="number" name="edit_total_area" id="edit_total_area" class="form-control">
                                    <select class="form-control" name="edit_area_type" id="edit_area_type">
                                         <option value="sq.m" selected>sq.m</option>
                                         <option value="has">has</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="edit_current_utilization">Current Utilization:</label>
                                <select class="form-select" name="edit_current_utilization" id="edit_current_utilization" required>
                                    <option value="NULL" selected>- Select -</option>
                                    <option value="WMSU Main Campus (Lot I)">WMSU Main Campus (Lot I)</option>
                                    <option value="WMSU Main Campus (Lot 2)">WMSU Main Campus (Lot 2)</option>
                                    <option value="External Academic Campus">External Academic Campus</option>
                                    <option value="Experimental Forest College of Forestry">Experimental Forest College of Forestry</option>
                                    <option value="ESU">ESU</option>
                                </select>
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
<script src="/js/landholdings.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.landholdings.list') }}",
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
           { data : "lot_number", name: "lot_number" },
           { data : "classification", name: "classification" },
           { data : "location", name: "location" },
           { data : "date_acquired", name: "date_acquired" },
           { data : "how_acquired", name: "how_acquired" },
           { data : "is_titled", name: "is_titled" },
           {
               data: 'total_area',
               name: 'total_area',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data==null?'':parseInt(data).toLocaleString()+' '+row.area_type
               }
           },
           { data : "current_utilization", name: "current_utilization" },
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