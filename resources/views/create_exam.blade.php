@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Create Exam</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('exams.index') }}">Exams</a>
                            </li>
                            <li class="breadcrumb-item active">Create Exam</li>
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
                        <h3 class="card-title">Add New Exam</h3>
                    </div>



                    <form action="{{ route('exams.store') }}" method="POST">
                        @csrf

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select name="class_id" id="class_id" class="form-control">
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

                                <div class="col-12 col-md-6">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Section Name</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option value="">Select Section</option>
                                        </select>
                                        @error('section_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Exam Name</label>
                                        <input type="text" name="exam_name" value="{{ old('exam_name') }}"
                                            class="form-control @error('exam_name') is-invalid @enderror"
                                            placeholder="Enter Exam Name">

                                        @error('exam_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Exam Date</label>
                                        <input type="date" name="exam_date" value="{{ old('exam_date') }}"
                                            class="form-control @error('exam_date') is-invalid @enderror">
                                        @error('exam_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('exams.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">
                                Save Exam
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
