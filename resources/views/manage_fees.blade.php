@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Student Fees List</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('fees.index') }}"> student Fees </a> </li>
                            <li class="breadcrumb-item active"> student Fees List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>




        <section class="content">
            <div class="container-fluid">

                @if (session('success'))
                    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Student Fees History</h3>
                        <a href="{{ route('fees.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Collect Fees
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="feesTable" class="table table-bordered table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Student</th>
                                    <th>Total Fees</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Last Payment</th>
                                    <th>History</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($fees as $fee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fee->student->name }}</td>
                                        <td>{{ $fee->total_fees }}</td>
                                        <td>{{ $fee->paid_amount }}</td>
                                        <td>{{ $fee->due_amount }}</td>
                                        <td>{{ $fee->last_payment_date }}</td>
                                        <td>
                                            <a href="{{ route('fees.show', $fee->student_id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View Payments
                                            </a>
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
            $('#feesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush


@push('scripts')
    <script>
        setTimeout(function() {
            let alertBox = document.getElementById('successAlert');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 10000);
    </script>
@endpush
