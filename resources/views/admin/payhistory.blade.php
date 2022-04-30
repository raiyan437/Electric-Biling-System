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
                <h1 class="m-0">Payment History</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-info" id="btnPrint">Print</button>
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
                        <th>Bill Month & Year</th>
                        <th>Pay Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->conid }}</td>
                        <td>{{ $item->appname }}</td>
                        <td>{{ $item->contactno }}</td>
                        <td>{{ $item->billmonth }} {{ $item->billyear }}</td>
                        <td>{{ $item->paydate }}</td>
                        <td><button class="btn btn-success btn-block" data-target="#detailsModal{{ $item->pid }}" data-toggle="modal">Details</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach($data as $item)
<div class="modal fade" id="detailsModal{{ $item->pid }}" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">Payment History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <h4>Txn ID</h4>
                <p>{{ $item->txnid }}</p>
            </div>
            <div class="form-group">
                <h4>Pay Method</h4>
                <p>{{ $item->method }}</p>
            </div>
        </div>
        <div class="modal-footer">
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

    $('#btnPrint').click(function(){
        window.print();
    });
</script>

@endsection
