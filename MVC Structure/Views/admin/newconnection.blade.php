@extends('layouts.admin_layout')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                 @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Register New Connection</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card p-3">
            <form method="POST" action="{{ route('admin_saveconnection') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 pt-2">
                        <p>Application Information</p>
                    </div>
                    <div class="col-lg-6 pt-2">
                        <label><b>Applicant Name <span style="color:red">*</span></b></label>
                        <input type="text" name="appname" class="form-control" required>
                    </div>
                    <div class="col-lg-4 pt-2">
                        <label><b>Applicant NID <span style="color:red">*</span></b></label>
                        <input type="text" name="nid" class="form-control" required>
                    </div>
                    <div class="col-lg-2 pt-2">
                        <label><b>Gender <span style="color:red">*</span></b></label>
                        <select class="custom-select" required name="gender">
                            <option value="" selected>--Select One Option--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-lg-6 pt-2">
                        <label><b>Connection Address <span style="color:red">*</span></b></label>
                        <textarea name="conaddress" class="form-control" required></textarea>
                    </div>
                    <div class="col-lg-3 pt-2">
                        <label><b>Contact Number <span style="color:red">*</span></b></label>
                        <input type="text" class="form-control" name="contactno" required />
                    </div>
                    <div class="col-lg-2 pt-2">
                        <label><b>Bill Starting Month <span style="color:red">*</span></b></label>
                        <select class="custom-select" required name="billmonth">
                            <option value="" selected>--Select One Option--</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                    <div class="col-lg-12 pt-2">
                        <hr>
                    </div>
                    <div class="col-lg-12 pt-2">
                        <p>User Information</p>
                    </div>
                    <div class="col-lg-6 pt-2">
                        <label><b>Email <span style="color:red">*</span></b></label>
                        <input type="email" class="form-control" name="email" required />
                    </div>
                    <div class="col-lg-6 pt-2">
                        <br>
                        <h3>Default Password For The Account WIll Be: 1234</h3>
                    </div>
                    <div class="col-lg-3 pt-3">
                        <button type="submit" class="btn btn-block btn-primary">Save Info</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection
