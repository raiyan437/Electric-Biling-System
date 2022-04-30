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
                        <th>Pay ID</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Amount</th>
                        <th>Txn ID</th>
                        <th>Pay Method</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td>{{ $item->pid }}</td>
                        <td>{{ $item->billmonth }}</td>
                        <td>{{ $item->billyear }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->txnid }}</td>
                        <td>{{ $item->method }}</td>
                        <td>{{ $item->pay_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#connections').DataTable();
    });
</script>

@endsection
