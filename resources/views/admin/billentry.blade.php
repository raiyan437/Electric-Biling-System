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
                <h1 class="m-0">Manual Bill Entry</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="card p-3">
            <table id="connections" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Connection ID</th>
                        <th>Applicant Name</th>
                        <th>Contact No</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->cid }}</td>
                        <td>{{ $item->appname }}</td>
                        <td>{{ $item->contactno }}</td>
                        <td><button class="btn btn-primary btn-block" data-target="#entryModal{{ $item->cid }}" data-toggle="modal">Entry</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach($data as $item)
<div class="modal fade" id="entryModal{{ $item->cid }}" tabindex="-1" aria-labelledby="entryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="entryModalLabel">Bill Entry For ABC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin_billsave') }}" id="entryForm{{ $item->cid }}" method="POST">
                @csrf
                <input type="hidden" name="conid" value="{{ $item->cid }}">
                <div class="form-group">
                    <label><b>Billing Month <span style="color:red">*</span></b></label>
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
                <div class="form-group">
                    <label><b>Billing Year <span style="color:red">*</span></b></label>
                    <input type="number" class="form-control" required name="billyear">
                </div>
                <div class="form-group">
                    <label><b>Amount <span style="color:red">*</span></b></label>
                    <input type="number" class="form-control" required name="amount">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="entryForm{{ $item->cid }}" class="btn btn-primary">Save changes</button>
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
