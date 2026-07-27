@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Assigned Subject To Teacher </h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('subjectAssignments.index') }}"> Sections
                                </a> </li>
                            <li class="breadcrumb-item active">Assigned Teacher List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Assigned Subjects</h3>
                        <a href="{{ route('subjectAssignments.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Assigned
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="sectionsTable" class="table table-bordered table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Teacher Name</th>
                                    <th>Subject</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($subjectAssignments as $subject)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subject->teacher->name }}</td>
                                        <td>{{ $subject->subject->name }}</td>
                                        <td>{{ $subject->class->name }}</td>
                                        <td>{{ $subject->section->name }}</td>
                                        <td>{{ $subject->created_at }}</td>
                                        <td>{{ $subject->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('subjectAssignments.edit', $subject->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('subjectAssignments.destroy', $subject->id) }}"
                                                method="POST" style="display:inline;">
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
            $('#sectionsTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
