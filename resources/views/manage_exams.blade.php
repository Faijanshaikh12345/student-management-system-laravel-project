@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Exams List</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('exams.index') }}"> Exams </a> </li>
                            <li class="breadcrumb-item active">Exam List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Exams</h3>
                        <a href="{{ route('exams.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Create Exam
                        </a>
                    </div>

                            <div class="card-body table-responsive">
                                <table id="examsTable" class="table table-bordered table-striped nowrap"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Class Name</th>
                                            <th>Section Name</th>
                                            <th>Exam Name</th>
                                            <th>Exam Date</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $exam->class->name }}</td>
                                                <td>{{ $exam->section->name }}</td>
                                                <td>{{ $exam->name }}</td>
                                                <td>{{ $exam->exam_date }}</td>
                                                <td>{{ $exam->created_at }}</td>
                                                <td>{{ $exam->updated_at }}</td>
                                                <td>
                                                    <a href="{{ route('exams.edit', $exam->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
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
            $('#examsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
