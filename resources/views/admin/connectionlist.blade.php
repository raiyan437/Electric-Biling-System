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
                <h1 class="m-0">Connection List</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card p-3">
            <table id="connections" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Connection ID</th>
                        <th>Applicant Name</th>
                        <th>Contact No</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->cid }}</td>
                        <td>{{ $item->appname }}</td>
                        <td>{{ $item->contactno }}</td>
                        <td><button class="btn btn-primary btn-block" data-target="#detailsModal{{ $item->cid }}" data-toggle="modal">Details</button></td>
                        <td><button class="btn btn-danger btn-block" data-target="#deleteModal{{ $item->cid }}" data-toggle="modal">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach ($data as $item)
<div class="modal fade" id="detailsModal{{ $item->cid }}" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="width: 45.7rem">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Connection Details# {{ $item->cid }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <h3><b>Connection Name: </b></h3>
                        <h4>{{ $item->appname }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Email: </b></h3>
                        <h4>{{ $item->nid }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>NID: </b></h3>
                        <h4>{{ $item->nid }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Gender: </b></h3>
                        <h4>{{ $item->nid }}</h4>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <h3><b>Address: </b></h3>
                        <h4>{{ $item->conaddress }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Contact No: </b></h3>
                        <h4>{{ $item->conaddress }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Bill Month: </b></h3>
                        <h4>{{ $item->billmonth }}</h4>
                    </div>
                    <div class="form-group">
                        <h3><b>Application Date: </b></h3>
                        <h4>{{ $item->appdate }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteModal{{ $item->cid }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete Connection# {{ $item->cid }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_deleteconnection') }}" id="deleteForm{{ $item->cid }}" method="POST">
                @csrf
                <input type="hidden" name="cid" value="{{ $item->cid }}">
                <input type="hidden" name="email" value="{{ $item->email }}">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="deleteForm{{ $item->cid }}" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
@endforeach

<script>
    $(document).ready(function() {
        $('#connections').DataTable();
    });
</script>

@endsection
