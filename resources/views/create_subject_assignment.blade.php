@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Assign Subject To Teacher</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('subjectAssignments.index') }}">Subject Assignments</a>
                            </li>
                            <li class="breadcrumb-item active">Create Assignments</li>
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
                        <h3 class="card-title">Add New Assignments</h3>
                    </div>



                    <form action="{{ route('subjectAssignments.store') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row">


                                <div class="col-12 col-md-3">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <select name="teacher_id"
                                            class="form-control @error('teacher_id') is-invalid @enderror">
                                            <option value="">Select Teacher</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">

                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <select name="subject_id"
                                            class="form-control @error('subject_id') is-invalid @enderror">
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('subject_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select name="class_id" id="class_id"
                                         class="form-control @error('class_id') is-invalid @enderror">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Section Name -->
                                <div class="col-12 col-md-3">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Section Name</label>
                                        <select name="section_id" id="section_id" 
                                         class="form-control @error('section_id') is-invalid @enderror">
                                            <option value="">Select Section</option>
                                        </select>
                                        @error('section_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('subjectAssignments.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-right">
                        Assign
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
        }, 10000); // 10 seconds
    </script>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#class_id').change(function() {
                var class_id = $(this).val();

                if (class_id) {
                    $.ajax({
                        url: "{{ url('/get-sections') }}/" + class_id,
                        type: 'GET',
                        success: function(data) {

                            $('#section_id').empty();
                            $('#section_id').append('<option value="">Select Section</option>');

                            $.each(data, function(key, section) {
                                $('#section_id').append(
                                    '<option value="' + section.id + '">' + section
                                    .name + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('#section_id').empty();
                }

            });

        });
    </script>
@endpush
