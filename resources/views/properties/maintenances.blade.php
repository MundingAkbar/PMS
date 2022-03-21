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
                            <label for="article">Article</label>
                            <select class="form-select border-secondary" id='article' name="article" required>
                                <option value="NULL" selected>- Select -</option>
                                @foreach ($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->article }}</option>
                                @endforeach
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
            <h5 class="modal-title" id="exampleModalLabel">Update Maintenance Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
              <input type="hidden" id="edit_id">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="edit_date_start">Date Start:</label>
                            <input type="date" class="form-control" name="edit_date_start" id="edit_date_start" required>
                        </div>
                        <div class="col">
                            <label for="edit_date_end">Date End:</label>
                            <input type="date" class="form-control" name="edit_date_end" id="edit_date_end" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="edit_working_days">No. of Workig Days:</label>
                            <input type="number" class="form-control" name="edit_working_days" id="edit_working_days" required>
                        </div>
                        <div class="col">
                            <label for="edit_office">Office/College:</label>
                            <select class="form-select border-secondary" id='edit_office' name="edit_office" required>
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
                            <label for="edit_units">No. of Units</label>
                            <input type="number" class="form-control" name="edit_units" id="edit_units" required>
                        </div>
                        <div class="col">
                            <label for="article">Article</label>
                            <select class="form-select border-secondary" id='edit_article' name="edit_article" required>
                                <option value="NULL" selected>- Select -</option>
                                @foreach ($articles as $article)
                                <option value="{{ $article->id }}">{{ $article->article }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
                </div>
          </form>
        </div>
    </div>
    </div>
    <!-- End of Update Modal -->
    <!-- =============================================================== -->
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
           { data : "article_name", name: "article_name" },
           { data : "date_start", name: "date_start" },
           { data : "date_end", name: "date_end" },
           {
                data: 'working_days',
                name: 'working_days',
                orderable: true,
                searchable: true,
                "render": function (data, type, row, meta){
                    return parseInt(data)==1?data+' day':data+' days';
                }
            },
           { data : "office_name", name: "office_name" },
           { data : "units", name: "units" },
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