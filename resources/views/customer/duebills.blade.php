@extends('layouts.customer_layout')

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
                <h1 class="m-0">Pending Bills</h1>
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
                        <th>Bill ID</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->bid }}</td>
                        <td>{{ $item->billmonth }}</td>
                        <td>{{ $item->billyear }}</td>
                        <td>{{ $item->amount }}</td>
                        <td><button class="btn btn-{{ $item->status == 'Reviewing' ? 'warning' : 'primary' }} btn-block" {{ $item->status == 'Reviewing' ? 'disabled' : '' }} data-target="#payModal{{ $item->bid }}" data-toggle="modal">{{ $item->status == 'Reviewing' ? 'Reviewing' : 'Pay Bill' }}</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@foreach($data as $item)
<div class="modal fade" id="payModal{{ $item->bid }}" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="payModalLabel">Pay Bill for {{ $item->billmonth }} {{ $item->billyear }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customer_paybills') }}" id="payForm{{ $item->bid }}" method="POST">
                @csrf
                <input type="hidden" name="bid" value="{{ $item->bid }}">
                <div class="form-group">
                    <label>Pay Amount</label>
                    <input type="number" name="payamount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Pay Method</label>
                    <select name="method" class="custom-select" required>
                        <option value="" selected>--Select An Option--</option>
                        <option value="Bkash">Bkash</option>
                        <option value="Rocket">Rocket</option>
                        <option value="Nogod">Nogod</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Txn. ID</label>
                    <input type="text" name="txnid" class="form-control" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" form="payForm{{ $item->bid }}" class="btn btn-success" {{ $item->status == 'Reviewing' ? 'disabled' : '' }}>Pay Bill</button>
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
