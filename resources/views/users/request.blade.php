@extends('layouts.app')

@section('content')
    <div class="properties-wrapper">
        <h3>Manage Request</h3>
        <div class="buttons">
            <div>
              <button class="btn btn-outline-dark add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Accept</button>
              <button class="btn btn-outline-danger add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button>
              <button class="btn btn-outline-success add-equipment" data-bs-toggle="modal" data-bs-target="#exampleModal">Done</button>
            </div>
            <button class="btn btn-dark add-equipment" data-bs-toggle="modal" data-bs-target="#equipmentModal">Add Request</button>         
        </div>
        <table id="myTable" class="stripe row-border order-column" style="width:100%">
            <thead>
                <tr>
                    <th>Actions</th>
                    <th>Status</th>
                    <th>Office/Department</th>
                    <th>Requested by</th>
                    <th>Nature of request</th>
                    <th>Technical personnel</th>
                    <th>Effective date</th>
                    <th>Date of request</th>
                    <th>Quantity/Units</th>
                    <th>Replaced parts</th>
                    <th>Amount of replaced parts</th>
                    <th>Findings</th>
                    <th>Date received</th>
                    <th>Recommending For</th>
                    <th>Date returned by</th>
                    <th>Accepted by</th>
                </tr>
            </thead>
            <tbody>
                {{-- @for($i=0; $i < 100; $i++)
                <tr>
                    <td>
                        <a href="" class="btn btn-danger">Delete</a>
                        <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Update</a>
                    </td>
                    <td><span class="badge {{ $i==2?'bg-danger':'bg-primary' }}">{{ $i==2?'rejected':'pending' }}</span></td>
                    <td>Akbar</td>
                    <td>Row 1 Data 2</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar lorem10</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar</td>
                    <td>Row 1 Data 2</td>
                    <td>Akbar</td>
                </tr>
                @endfor --}}
                <!--
                <tr>
                    <td>Nadir</td>
                    <td>Row 2 Data 2</td>
                </tr> -->
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
            </tfoot> --}}
        </table>
    </div>

    <!-- =============================================================== -->
    <!-- Add Modal -->
    <div class="modal hide fade in" id="requestModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">Add Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                    <!-- equipment details -->
                    <div class="row">
                        <div class="col">
                            <!-- request forms -->
                                <!-- input group -->
                                <div class="row">
                                    <div class="col">
                                        <label for="effective_date">Effective Date:</label>
                                        <input type="date" class="form-control border-secondary" name="effective_date"  id="effective_date" required>
                                    </div>
                                    <div class="col">
                                        <label for="date_of_request">Date of Request:</label>
                                        <input type="date" name="date_of_request" id="date_of_request" class="form-control border-secondary">
                                    </div>
                                </div>
                                <!-- end of input group -->
                                <!-- input group -->
                                <div class="row">
                                    <div class="col">
                                        <label for="office">College/Office:</label>
                                        <select class="form-select border-secondary" name="office" id="office" required>
                                            <option value="NULL" selected>- Select Office/Department -</option>
                                            @foreach($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="units">Quantity/Unit:</label>
                                        <input type="number" class="form-control border-secondary" name="units" id="units" required>
                                    </div>
                                </div>
                                <!-- end of input group -->
                                <hr>
                                <fieldset>
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="nature_of_request">Nature of Request</label>
                                            <select class="form-select border-secondary" name="nature_of_request" id="nature_of_request">
                                                <option selected>- Select Nature of Request -</option>
                                                <option value="Repair">Repair</option>
                                                <option value="Cleaning">Cleaning</option>
                                                <option value="Installation (New)">Installation (New)</option>
                                                <option value="Installation (Replacement)">Installation (Replacement)</option>
                                                <option value="Pull-out for Disposal">Pull-out for Disposal</option>
                                                <option value="Pull-out for Storage">Pull-out for Storage</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="replaced_parts">Replaced Parts (if any):</label>
                                                <input type="text" class="form-control border-secondary" id="replaced_parts" name="replaced_parts">
                                        </div>
                                        <div class="col">
                                            <label for="amount_of_replaced_parts">Estimated amount of Replaced parts:</label>
                                            <div class="input-group">
                                                <div class="input-group-text">₱</div>
                                                <input type="number" class="form-control border-secondary" id="amount_of_replaced_parts" name="amount_of_replaced_parts" placeholder="0.0">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                     <!-- input group -->
                                     <div class="row">
                                        <div class="col">
                                            <label for="status">Status</label>
                                            <select class="form-select border-secondary" name="status" id="status" required>
                                                <option selected>- Select Status -</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                </fieldset>
                                <hr>
                                <fieldset>
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="requested_by">Requested by:</label>
                                            <select class="form-select border-secondary" name="requested_by" id="requested_by" required>
                                                <option value="NULL" selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="technical_personnel">Assigned Technical Personnel:</label>
                                            <select class="form-select border-secondary" name="technical_personnel" id="technical_personnel" required>
                                                <option value="NULL" selected>- Select -</option>
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
                                            <label for="date_received">Date Received:</label>
                                            <input type="date" class="form-control border-secondary" name="date_received"  id="date_received" required>
                                        </div>
                                        <div class="col">
                                            <label for="findings">Findings:</label>
                                            <input type="text" class="form-control border-secondary" name="findings" id="findings" required>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="action_taken">Action Taken:</label>
                                            <input type="text" class="form-control border-secondary" name="action_taken" id="action_taken" required>
                                        </div>
                                        <div class="col">
                                            <label for="recommending_for">Recommending For:</label>
                                            <select class="form-select border-secondary" name="recommending_for" id="recommending_for" required>
                                                <option selected>- Select Recommending For -</option>
                                                <option value="Cleaning">Cleaning</option>
                                                <option value="Repair">Repair</option>
                                                <option value="Installation">Installation</option>
                                                <option value="Pull-out for Disposal">Pull-out for Disposal</option>
                                                <option value="Pull-out for Storage">Pull-out for Storage</option>
                                                <option value="Property Management Office">Property Management Office</option>
                                                <option value="University Service Center">University Service Center</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="date_returned_by">Date Returned By:</label>
                                            <select class="form-select border-secondary" name="date_returned_by" id="date_returned_by" required>
                                                <option selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="accepted_by">Accepted By:</label>
                                            <select class="form-select border-secondary" id="accepted_by" name="accepted_by" required>
                                                <option selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                </fieldset>
                                <!-- end of request form -->
                        </div>
                    </div>
                    
                    </div>
                    <div class="modal-footer">
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
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <form action="">
                <input type="hidden" id="edit_id">
                    <!-- equipment details -->
                    <div class="row">
                        <div class="col">
                            <!-- request forms -->
                                <!-- input group -->
                                <div class="row">
                                    <div class="col">
                                        <label for="edit_effective_date">Effective Date:</label>
                                        <input type="date" class="form-control border-secondary" name="edit_effective_date"  id="edit_effective_date" required>
                                    </div>
                                    <div class="col">
                                        <label for="edit_date_of_request">Date of Request:</label>
                                        <input type="date" name="edit_date_of_request" id="edit_date_of_request" class="form-control border-secondary">
                                    </div>
                                </div>
                                <!-- end of input group -->
                                <!-- input group -->
                                <div class="row">
                                    <div class="col">
                                        <label for="edit_office">College/Office:</label>
                                        <select class="form-select border-secondary" name="edit_office" id="edit_office" required>
                                            <option value="NULL" selected>- Select Office/Department -</option>
                                            @foreach($offices as $office)
                                            <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="edit_units">Quantity/Unit:</label>
                                        <input type="number" class="form-control border-secondary" name="edit_units" id="edit_units" required>
                                    </div>
                                </div>
                                <!-- end of input group -->
                                <hr>
                                <fieldset>
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="edit_nature_of_request">Nature of Request</label>
                                            <select class="form-select border-secondary" name="edit_nature_of_request" id="edit_nature_of_request">
                                                <option selected>- Select Nature of Request -</option>
                                                <option value="Repair">Repair</option>
                                                <option value="Cleaning">Cleaning</option>
                                                <option value="Installation (New)">Installation (New)</option>
                                                <option value="Installation (Replacement)">Installation (Replacement)</option>
                                                <option value="Pull-out for Disposal">Pull-out for Disposal</option>
                                                <option value="Pull-out for Storage">Pull-out for Storage</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="edit_replaced_parts">Replaced Parts (if any):</label>
                                                <input type="text" class="form-control border-secondary" id="edit_replaced_parts" name="edit_replaced_parts">
                                        </div>
                                        <div class="col">
                                            <label for="edit_amount_of_replaced_parts">Estimated amount of Replaced parts:</label>
                                            <div class="input-group">
                                                <div class="input-group-text">₱</div>
                                                <input type="number" class="form-control border-secondary" id="edit_amount_of_replaced_parts" name="edit_amount_of_replaced_parts" placeholder="0.0">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                     <!-- input group -->
                                     <div class="row">
                                        <div class="col">
                                            <label for="edit_status">Status</label>
                                            <select class="form-select border-secondary" name="edit_status" id="edit_status" required>
                                                <option selected>- Select Status -</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Accepted">Accepted</option>
                                                <option value="Rejected">Rejected</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                </fieldset>
                                <hr>
                                <fieldset>
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="edit_requested_by">Requested by:</label>
                                            <select class="form-select border-secondary" name="edit_requested_by" id="edit_requested_by" required>
                                                <option value="NULL" selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="edit_technical_personnel">Assigned Technical Personnel:</label>
                                            <select class="form-select border-secondary" name="edit_technical_personnel" id="edit_technical_personnel" required>
                                                <option value="NULL" selected>- Select -</option>
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
                                            <label for="edit_date_received">Date Received:</label>
                                            <input type="date" class="form-control border-secondary" name="edit_date_received"  id="edit_date_received" required>
                                        </div>
                                        <div class="col">
                                            <label for="edit_findings">Findings:</label>
                                            <input type="text" class="form-control border-secondary" name="edit_findings" id="edit_findings" required>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="edit_action_taken">Action Taken:</label>
                                            <input type="text" class="form-control border-secondary" name="edit_action_taken" id="edit_action_taken" required>
                                        </div>
                                        <div class="col">
                                            <label for="edit_recommending_for">Recommending For:</label>
                                            <select class="form-select border-secondary" name="edit_recommending_for" id="edit_recommending_for" required>
                                                <option selected>- Select Recommending For -</option>
                                                <option value="Cleaning">Cleaning</option>
                                                <option value="Repair">Repair</option>
                                                <option value="Installation">Installation</option>
                                                <option value="Pull-out for Disposal">Pull-out for Disposal</option>
                                                <option value="Pull-out for Storage">Pull-out for Storage</option>
                                                <option value="Property Management Office">Property Management Office</option>
                                                <option value="University Service Center">University Service Center</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                    <!-- input group -->
                                    <div class="row">
                                        <div class="col">
                                            <label for="date_returned_by">Date Returned By:</label>
                                            <select class="form-select border-secondary" name="edit_date_returned_by" id="edit_date_returned_by" required>
                                                <option selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="edit_accepted_by">Accepted By:</label>
                                            <select class="form-select border-secondary" id="edit_accepted_by" name="edit_accepted_by" required>
                                                <option selected>- Select -</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- end of input group -->
                                </fieldset>
                                <!-- end of request form -->
                        </div>
                    </div>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="update_btn">Update</button>
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
                <h5 class="modal-title" id="equipmentModalLabel">Select Equipment/Vehicle(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4><span id="total_selected">0</span> selected Equipment/Vehicle(s)</h4>
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
                        <th>Remarks</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $equipment as $e)
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                @if($e->request == NULL)
                                     <input type="checkbox" class="form-check-input chk_equipment border-dark" name="ids" id="ids" value="{{ $e->id.',e' }}">
                                @endif
                            </div>
                        </td>
                        <td>{{ $e->article_name }}</td>
                        <td>{{ $e->office_name }}</td>
                        <td>{{ $e->first_name.' '.$e->last_name }}</td>
                        <td>{{ $e->property_number }}</td>
                        <td>{{ $e->account_code }}</td>
                        <td>{{ $e->remarks }}</td>
                        <td>{{ $e->description }}</td>
                    </tr>
                    @endforeach
                    @foreach( $vehicles as $v)
                    <tr>
                        <td>
                            <div class="row justify-content-center">
                                @if($v->request == NULL)
                                <input type="checkbox" class="form-check-input chk_equipment border-dark" name="ids" id="ids" value="{{ $v->id.',v' }}">
                                @endif
                            </div>
                        </td>
                        <td>{{ $v->article_name }}</td>
                        <td>{{ $v->office_name }}</td>
                        <td>{{ $v->first_name.' '.$v->last_name }}</td>
                        <td>{{ $v->property_number }}</td>
                        <td>{{ $v->account_code }}</td>
                        <td>{{ $v->remarks }}</td>
                        <td>{{ $v->description }}</td>
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
<script src="/js/request.js"></script>
<script>
    //datatable ajax 
    var table = $('#myTable').DataTable({
       processing: true,
       serverSide: true,
       ajax: "{{ route('get.requests.list') }}",
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
           {
               data: 'status',
               name: 'status',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   if(data == 'Accepted'){
                       return "<span class='badge bg-dark'>"+data+"</span>"
                   }else if(data == 'Rejected'){
                        return "<span class='badge bg-danger'>"+data+"</span>"
                   }else if(data == 'Pending'){
                        return "<span class='badge bg-secondary'>"+data+"</span>"
                   }else{
                         return "<span class='badge bg-success'>"+data+"</span>"
                   }
               }
           },
           { data : "office_name", name: "office_name" },
           {
               data: 'requested_by_fname',
               name: 'requested_by_fname',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data+' '+row.requested_by_lname
               }
           },
           { data : "nature_of_request", name: "nature_of_request" },
           {
               data: 'assigned_personnel_fname',
               name: 'assigned_personnel_fname',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data+' '+row.assigned_personnel_lname
               }
           },
           { data : "effective_date", name: "effective_date" },
           { data : "date_of_request", name: "date_of_request" },
           { data : "quantity", name: "quantity" },
           { data : "replaced_parts", name: "replaced_parts" },
           {
               data: 'amount_of_replaced_parts',
               name: 'amount_of_replaced_parts',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return '₱ '+parseInt(data).toLocaleString()
               }
           },
           { data : "findings", name: "findings" },
           { data : "date_received", name: "date_received" },
           { data : "recommending_for", name: "recommending_for" },
           {
               data: 'returned_by_fname',
               name: 'returned_by_fname',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data+' '+row.returned_by_lname
               }
           },
           {
               data: 'accepted_by_fname',
               name: 'accepted_by_fname',
               orderable: true,
               searchable: true,
               "render": function (data, type, row, meta){
                   return data+' '+row.accepted_by_lname
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