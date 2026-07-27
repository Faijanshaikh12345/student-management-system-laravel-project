@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <h1>Enter Students Marks</h1>
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


                <form action="{{ route('marks.save') }}" method="POST">
                    @csrf

                    <input type="hidden" name="exam_id" value="{{ $exam_id }}">
                    <input type="hidden" name="subject_id" value="{{ $subject_id }}">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="marksEntryTable" class="table table-bordered table-striped nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Roll No</th>
                                        <th>Student Name</th>
                                        <th>Total Marks</th>
                                        <th>Marks Obtained</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->roll_number }}</td>
                                            <td>{{ $student->name }}</td>

                                            {{-- Max Marks Column --}}
                                            <td>
                                                <input type="number" name="max_marks[{{ $student->id }}]"
                                                    class="form-control" required>
                                            </td>

                                            {{-- Obtained Marks --}}
                                            <td>
                                                <input type="number" name="marks[{{ $student->id }}]" class="form-control"
                                                    required>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-3">
                                <a href="{{ route('marks.create') }}" class="btn btn-secondary">Back</a>
                                <button type="submit" class="btn btn-primary float-right">
                                    Save Marks
                                </button>
                            </div>

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
            $('#marksEntryTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10
            });
        });
    </script>
@endpush
