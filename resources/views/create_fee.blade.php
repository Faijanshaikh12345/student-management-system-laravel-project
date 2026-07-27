@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Collect Student Fees</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('fees.index') }}">Student Fees</a>
                            </li>
                            <li class="breadcrumb-item active">Collect Fees</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <!-- Form -->
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
                        <h3 class="card-title">Add Fee Payment</h3>
                    </div>

                    <form action="{{ route('fees.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">

                                <!-- Student Select -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Select Student</label>
                                        <select name="student_id"
                                            class="form-control @error('student_id') is-invalid @enderror">
                                            <option value="">Select Student</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">
                                                    {{ $student->name }} (Roll: {{ $student->roll_number }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Amount Paid -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Amount Paid</label>
                                        <input type="number" name="amount_paid" value="{{ old('amount_paid') }}"
                                            class="form-control @error('amount_paid') is-invalid @enderror"
                                            placeholder="Enter amount">
                                        @error('amount_paid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Payment Date -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Payment Date</label>
                                        <input type="date" name="payment_date" value="{{ old('payment_date') }}"
                                            class="form-control @error('payment_date') is-invalid @enderror">
                                        @error('payment_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Payment Mode -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Payment Mode</label>
                                        <select name="payment_mode"
                                            class="form-control @error('payment_mode') is-invalid @enderror">
                                            <option value="">Select Mode</option>
                                            <option value="cash">Cash</option>
                                            <option value="online">Online</option>
                                        </select>
                                        @error('payment_mode')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('fees.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">
                                Save Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection


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