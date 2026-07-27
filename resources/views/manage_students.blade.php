@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Students List</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('students.index') }}"> Students </a> </li>
                            <li class="breadcrumb-item active">Students List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Students</h3>
                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Create Students
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="studentsTable" class="table table-bordered table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Roll.No</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Class Name</th>
                                    <th>Section Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->roll_number }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->parent_name }}</td>
                                        <td>{{ $student->class->name }}</td>
                                        <td>{{ $student->section->name }}</td>
                                        <td>{{ $student->created_at }}</td>
                                        <td>{{ $student->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('students.edit', $student->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
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
            $('#studentsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
