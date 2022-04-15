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
                <h1 class="m-0">Payment Requests</h1>
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
                        <th>Amount</th>
                        <th>Pay Method</th>
                        <th>Txn ID</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->conid }}</td>
                        <td>{{ $item->appname }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->method }}</td>
                        <td>{{ $item->txnid }}</td>
                        <td><button class="btn btn-success btn-block" data-target="#acceptModal{{ $item->pid }}" data-toggle="modal">Accept</button></td>
                        <td><button class="btn btn-danger btn-block" data-target="#rejectModal{{ $item->pid }}" data-toggle="modal">Reject</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach($data as $item)
<div class="modal fade" id="acceptModal{{ $item->pid }}" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="acceptModalLabel">Accept Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="acceptForm{{ $item->pid }}" action="{{ route('admin_acceptpayment') }}" method="POST">
                @csrf
                <input type="hidden" name="pid" value="{{ $item->pid }}">
                <input type="hidden" name="bid" value="{{ $item->bid }}">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button form="acceptForm{{ $item->pid }}" type="submit" class="btn btn-success">Accept Payment</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="rejectModal{{ $item->pid }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rejectModalLabel">Reject Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="rejectForm{{ $item->pid }}" action="{{ route('admin_rejectpayment') }}" method="POST">
                @csrf
                <input type="hidden" name="pid" value="{{ $item->pid }}">
                <input type="hidden" name="bid" value="{{ $item->bid }}">
                <h3>Are You Sure?</h3>
            </form>
        </div>
        <div class="modal-footer">
          <button form="rejectForm{{ $item->pid }}" type="submit" class="btn btn-danger">Reject</button>
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
