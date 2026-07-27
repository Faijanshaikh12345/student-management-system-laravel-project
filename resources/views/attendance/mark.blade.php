@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Mark Attendance ({{ $date }})</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Attendance</li>
                            <li class="breadcrumb-item active">Mark</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <!-- Content -->
        <section class="content">
            <div class="container-fluid">

                <form method="POST" action="{{ route('attendance.save') }}">
                    @csrf
                    <input type="hidden" name="date" value="{{ $date }}">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Students List</h3>

                            <button type="submit" class="btn btn-success btn-sm float-right">
                                <i class="fas fa-save"></i> Save Attendance
                            </button>
                        </div>

                        <div class="card-body">
                            <table id="attendanceTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Roll No</th>
                                        <th>Student Name</th>
                                        <th width="150">Present</th>
                                        <th width="150">Absent</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $student->name }}</td>

                                            <td class="text-center">
                                                <input type="radio" name="status[{{ $student->id }}]" value="present"
                                                    checked>
                                            </td>

                                            <td class="text-center">
                                                <input type="radio" name="status[{{ $student->id }}]" value="absent">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <a href="{{ route('attendance.select') }}" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#attendanceTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 25
            });
        });
    </script>
@endpush
