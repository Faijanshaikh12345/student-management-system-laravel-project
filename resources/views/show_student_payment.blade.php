@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Student Fees History</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('fees.index') }}"> student Fees </a> </li>
                            <li class="breadcrumb-item active"> student Fees History</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Student Fees History</h3>
                        <a href="{{ route('fees.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Collect Fees
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="studentPaymentsTable" class="table table-bordered table-striped nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Mode</th>
                                    <th>Receipt</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payment->amount_paid }}</td>
                                        <td>{{ $payment->payment_date }}</td>
                                        <td>{{ $payment->payment_mode }}</td>
                                        <td>{{ $payment->receipt_no }}</td>
                                        <td>
                                            <form action="{{ route('fees.destroy', $payment->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure to delete?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




@push('scripts')
    <script>
        $(document).ready(function() {
            $('#studentPaymentsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
