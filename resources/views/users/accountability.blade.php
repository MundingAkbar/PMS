@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Accountabilities</h3>
        <div class="buttons">
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Make Request</button>         
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
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @for($i=0; $i < 100; $i++)
                <tr>
                    <td>
                        <a href="" class="btn btn-danger">Delete</a>
                        <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</a>
                    </td>
                    <td>Row 1 Data a{{$i}}</td>
                    <td>Akbar</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar lorem10</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar</td>
                    <td>₱ Row 1 Data 2</td>
                    <td>₱ Akbar</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar</td>
                </tr>
                @endfor
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
                    <td>
                        <select data-column="5" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="0" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="6" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="7" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="8" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
                        </select>
                    </td>
                    <td>
                        <select data-column="9" class="form-control filter-select">
                            <option value="">Select</option>
                            <option value="">Name</option>
                            <option value="">Name</option>
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
            <h5 class="modal-title" id="exampleModalLabel">Add Equipment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="">
                <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="article">Article:</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>- Select Article -</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="requisitioner">Requisitioner:</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>- Select Requisitioner -</option>
                                <option value="1">No Requisitioner</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="deployment">Deployment:</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>- Select Office/Department -</option>
                                <option value="1">Not Deployed</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="property_number">Property Number:</label>
                            <input type="text" class="form-control" name="property_number"  aria-label="Last name" required>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="account_code">Account Code:</label>
                            <input type="text" class="form-control" name="account_code"  aria-label="First name" disabled required>
                        </div>
                        <div class="col">
                            <label for="remarks">Remarks:</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>- Select Remarks -</option>
                                <option value="1">Usable</option>
                                <option value="2">Not-Usable</option>
                            </select>
                        </div>
                    </div>
                    <!-- end of input group -->
                    <!-- input group -->
                    <div class="row">
                        <div class="col">
                            <label for="units">Units:</label>
                            <input type="number" class="form-control" name="units"  aria-label="First name" required>
                        </div>
                        <div class="col">
                            <label for="unit_value">Unit Value:</label>
                            <div class="input-group">
                                <div class="input-group-text">₱</div>
                                <input type="text" class="form-control" id="unit_value" name="unit_value" placeholder="0.0" required>
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
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" name="description" aria-label="Last name" required>
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
                <h5 class="modal-title" id="updateModalLabel">Update Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- input group -->
                <div class="row">
                    <div class="col">
                        <label for="article">Article:</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>- Select Article -</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="requisitioner">Requisitioner:</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>- Select Requisitioner -</option>
                            <option value="1">No Requisitioner</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <!-- end of input group -->
                <!-- input group -->
                <div class="row">
                    <div class="col">
                        <label for="deployment">Deployment:</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>- Select Office/Department -</option>
                            <option value="1">Not Deployed</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="property_number">Property Number:</label>
                        <input type="text" class="form-control" name="property_number"  aria-label="Last name" required>
                    </div>
                </div>
                <!-- end of input group -->
                <!-- input group -->
                <div class="row">
                    <div class="col">
                        <label for="account_code">Account Code:</label>
                        <input type="text" class="form-control" name="account_code"  aria-label="First name" disabled required>
                    </div>
                    <div class="col">
                        <label for="remarks">Remarks:</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>- Select Remarks -</option>
                            <option value="usable">Usable</option>
                            <option value="not-usable">Not-Usable</option>
                        </select>
                    </div>
                </div>
                <!-- end of input group -->
                <!-- input group -->
                <div class="row">
                    <div class="col">
                        <label for="units">Units:</label>
                        <input type="number" class="form-control" name="units"  aria-label="First name" required>
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
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" aria-label="Last name" required>
                    </div>
                </div>
                <!-- end of input group -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End of Add Modal -->
@include('layouts.footer')
@endsection

@section('scripts')
<script src="/js/equipment.js"></script>
@endsection