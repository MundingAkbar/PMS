@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Vehicles</h3>
        <div class="buttons">
            <button class="btn border-secondary add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Vehicle</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Article</th>
                    <th>Deployment</th>
                    <th>Requisitioner</th>
                    <th>Property Number</th>
                    <th>Account Code</th>
                    <th>Units</th>
                    <th>Unit Value</th>
                    <th>Total Value</th>
                    <th>Remarks</th>
                    <th>Registration</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <!--
                <tr>
                    <td>Nadir</td>
                    <td>Row 2 Data 2</td>
                </tr> -->
            </tbody>
            <tfoot>
                <tr>
                    <td>
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
                            @foreach($offices as $office)
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
                        <select data-column="9" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="Usable">Usable</option>
                            <option value="Not Usable">Not Usable</option>
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
    <!-- Add Vehicles -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="article">Article:</label>
                            <select class="form-select" id="article" name="article" required>
                                <option value="NULL" selected>- Select Article -</option>
                                @foreach($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->article }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="requisitioner">Requisitioner:</label>
                            <select class="form-select" id="requisitioner" name="requisitioner" aria-label="Default select example" required>
                                <option value="NULL" selected>- Select Requisitioner -</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="deployment">Deployment:</label>
                            <select class="form-select" id="deployment" name="deployment" aria-label="Default select example" required>
                                <option  value="NULL" selected>- Select Office/Department -</option>
                                @foreach( $offices as $office )
                                    <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="property_number">Property Number:</label>
                            <input type="text" class="form-control" id="property_number" name="property_number"  aria-label="Last name" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="registration_date">Registration Date</label>
                            <input type="date" class="form-control" id="registration_date" name="registration_date" placeholder="0.0" required>
                        </div>
                        <div class="col">
                            <label for="remarks">Remarks:</label>
                            <select class="form-select" id="remarks" name="remarks" required>
                                <option selected>- Select Remarks -</option>
                                <option value="Usable">Usable</option>
                                <option value="Not Usable">Not Usable</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="units">Units:</label>
                            <input type="number" class="form-control" name="units" id="units" required>
                        </div>
                        <div class="col">
                            <label for="unit_value">Unit Value:</label>
                            <div class="input-group">
                                <div class="input-group-text">₱</div>
                                <input type="number" class="form-control" id="unit_value" name="unit_value" placeholder="0.0" required>
                            </div>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="total_value">Total Value:</label>
                            <div class="input-group">
                                <div class="input-group-text">₱</div>
                                <input type="text" class="form-control" id="total_value" name="total_value" placeholder="0.0" disabled required>
                            </div>
                        </div>
                        <div class="col">
                           
                        </div>
                    </div>
                    <!-- end of input group -->
                     <!-- input group -->
                     <div class="row">
                         <div class="col">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
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
                <h5 class="modal-title" id="updateModalLabel">Update Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                    <input type="hidden" id="edit_id">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_article">Article:</label>
                                <select class="form-select" id="edit_article" name="edit_article" required>
                                    <option value="NULL" selected>- Select Article -</option>
                                    @foreach($articles as $article)
                                    <option value="{{ $article->id }}">{{ $article->article }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="edit_requisitioner">Requisitioner:</label>
                                <select class="form-select" id="edit_requisitioner" name="edit_requisitioner" aria-label="Default select example" required>
                                    <option value="NULL" selected>- Select Requisitioner -</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_deployment">Deployment:</label>
                                <select class="form-select" id="edit_deployment" name="edit_deployment" aria-label="Default select example" required>
                                    <option  value="NULL" selected>- Select Office/Department -</option>
                                    @foreach( $offices as $office )
                                        <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="edit_property_number">Property Number:</label>
                                <input type="text" class="form-control" id="edit_property_number" name="edit_property_number"  aria-label="Last name" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_registration_date">Registration Date</label>
                                <input type="date" class="form-control" id="edit_registration_date" name="edit_registration_date" placeholder="0.0" required>
                            </div>
                            <div class="col">
                                <label for="edit_remarks">Remarks:</label>
                                <select class="form-select" id="edit_remarks" name="edit_remarks" required>
                                    <option selected>- Select Remarks -</option>
                                    <option value="Usable">Usable</option>
                                    <option value="Not Usable">Not Usable</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_units">Units:</label>
                                <input type="number" class="form-control" name="edit_units" id="edit_units" required>
                            </div>
                            <div class="col">
                                <label for="edit_unit_value">Unit Value:</label>
                                <div class="input-group">
                                    <div class="input-group-text">₱</div>
                                    <input type="number" class="form-control" id="edit_unit_value" name="edit_unit_value" placeholder="0.0" required>
                                </div>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="edit_total_value">Total Value:</label>
                                <div class="input-group">
                                    <div class="input-group-text">₱</div>
                                    <input type="text" class="form-control" id="edit_total_value" name="edit_total_value" placeholder="0.0" disabled required>
                                </div>
                            </div>
                            <div class="col">
                               
                            </div>
                        </div>
                        <!-- end of input group -->
                         <!-- input group -->
                         <div class="row">
                             <div class="col">
                                <label for="edit_description">Description:</label>
                                <textarea class="form-control" name="edit_description" id="edit_description" cols="30" rows="5"></textarea>
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
    <!-- End of Update Modal -->
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
<script src="/js/vehicles.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.vehicles.list') }}",
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
           { data : "article_name", name: "article_name" },
           { data : "office_name", name: "office_name" },
           {
               data: 'first_name',
               name: 'first_name',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data==null?'':data+' '+row.last_name
               }
           },
           { data : "property_number", name: "property_number" },
           { data : "account_code", name: "account_code" },
           { data : "units", name: "units" },
           {
               data: 'unit_value',
               name: 'unit_value',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return '₱'+parseInt(data).toLocaleString()
               }
           },
           {
               data: 'total_value',
               name: 'total_value',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return '₱'+parseInt(data).toLocaleString()
               }
           },
           { data : "remarks", name: "remarks" },
           { data : "registration_date", name: "registration_date"},
           { data : "description", name: "description" },
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