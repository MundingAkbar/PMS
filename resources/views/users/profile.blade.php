@extends('layouts.app')

@section('content')
    <div class="wrapper profile-wrapper">
        <img src="/img/user.png" alt="user profile">
        <div class="user-details">
            <h3>{{ strtoupper(Auth::user()->first_name) }} {{ strtoupper(Auth::user()->middle_name) }} {{ strtoupper(Auth::user()->last_name) }}</h3>
            <h6><b>Role:</b> {{ ucwords(Auth::user()->role) }}</h6>
            <div class="information">
                <p><b>Office/Department:</b> {{ ucwords( $user[0]->office_name ) }}</p>
                 <p><b>Email:</b> {{ Auth::user()->email }}</p>
                 <p><b>Contact Number:</b> {{ Auth::user()->contact_number }}</p>
                 <p><b>Address:</b> {{ Auth::user()->address }}</p>
            </div>
            <div class="user-buttons">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#updateModal">Edit Profile</button>
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#equipmentModal">View assigned Equipment</button>
             </div>
        </div>
    </div>

  
    <!-- =============================================================== -->
    <!-- Edit Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
                    <!-- input group -->
                        <div class="row">
                            <div class="col">
                                <label for="article">FIrst Name:*</label>
                                <input type="text" class="form-control" name="first_name"  aria-label="First name" required>
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
                                <label for="units">Address:*</label>
                                <input type="text" class="form-control" name="units"  aria-label="First name" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                        <hr>
                        <h4>Change Password</h4>
                           <!-- input group -->
                           <div class="row">
                            <div class="col">
                                <label for="account_code">Old Password:*</label>
                                <input type="password" class="form-control" name="account_code"  aria-label="First name" required>
                            </div>
                            <div class="col">
                                <label for="remarks">New Password:*</label>
                                <input type="password" class="form-control" name="account_code"  aria-label="First name" required>
                            </div>
                        </div>
                        <!-- end of input group -->
                            <!-- input group -->
                            <div class="row">
                            <div class="col">
                            </div>
                            <div class="col">
                                <label for="remarks">Confirm Password:*</label>
                                <input type="password" class="form-control" name="account_code"  aria-label="First name" required>
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
    <!-- End of Edit Modal -->
     <!-- =============================================================== -->
    <!-- Edit Modal -->
    <div class="modal fade" id="equipmentModal" tabindex="-1" aria-labelledby="equipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="equipmentModalLabel">Assigned Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="">
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
                                <label for="units">Address:*</label>
                                <input type="text" class="form-control" name="units"  aria-label="First name" required>
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
    <!-- End of Edit Modal -->
   
@endsection

@section('scripts')
<script src="/js/profile.js"></script>
@endsection