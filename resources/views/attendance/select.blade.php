@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Take Attendance</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Attendance</li>
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
                    <h3 class="card-title">Select Class, Section & Date</h3>
                </div>

                <form method="POST" action="{{ route('attendance.show') }}">
                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <!-- Class -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Class</label>
                                    <select name="class_id" class="form-control" required>
                                        <option value="">Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Section -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Section</label>
                                    <select name="section_id" class="form-control" required>
                                        <option value="">Select Section</option>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Date -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Select Date</label>
                                    <input type="date" name="date" class="form-control" required>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            Show Students
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