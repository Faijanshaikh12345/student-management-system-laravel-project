@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <!-- Left: Title -->
                    <div class="col-sm-6">
                        <h1 class="m-0">Classes List</h1>
                    </div>

                    <!-- Right: Breadcrumb -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('class.index') }}"> Classes </a> </li>
                            <li class="breadcrumb-item active">Class List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Class</h3>

                        <a href="{{ route('class.create') }}" class="btn btn-primary btn-sm float-right">
                            <i class="fas fa-plus"></i> Create Class
                        </a>
                    </div>


                    <div class="card-body table-responsive">
                        <table id="classesTable" class="table table-bordered table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $class->name }}</td>
                                        <td>{{ $class->description }}</td>
                                        <td>{{ $class->created_at }}</td>
                                        <td>{{ $class->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('class.edit', $class->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('class.destroy', $class->id) }}" method="POST"
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
            $('#classesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
