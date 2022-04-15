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
                <h1 class="m-0">Change Password</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container" style="width: 30%">
        <div class="card p-3">
            <form action="{{ route('admin_savepassword') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="currpass" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="pass1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="pass2" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
