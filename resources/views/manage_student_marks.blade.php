@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Students Marks List</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('marks.index') }}"> Students Marks</a>
                            </li>
                            <li class="breadcrumb-item active">Students Marks List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Students Marks</h3>
                        <a href="{{ route('marks.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Add Students Marks
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="studentsMarksTable" class="table table-bordered table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Exam</th>
                                    <th>Total Marks</th>
                                    <th>Marks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($marks as $mark)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mark->student->name }}</td>
                                        <td>{{ $mark->subject->name }}</td>
                                        <td>{{ $mark->exam->name }}</td>
                                        <td>{{ $mark->max_marks }}</td>
                                        <td>{{ $mark->marks_obtained }}</td>
                                        <td>

                                            <form action="{{ route('marks.destroy', $mark->id) }}" method="POST"
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
            $('#studentsMarksTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
