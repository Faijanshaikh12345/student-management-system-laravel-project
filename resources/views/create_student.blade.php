@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Create Student</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('students.index') }}">Students</a>
                            </li>
                            <li class="breadcrumb-item active">Create Student</li>
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
                        <h3 class="card-title">Add New Student</h3>
                    </div>



                    <form action="{{ route('students.store') }}" method="POST">
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



                                <!-- Subject Code -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Roll Number </label>
                                        <input type="text" name="roll_number" value="{{ old('roll_number') }}"
                                            class="form-control @error('roll_number') is-invalid @enderror"
                                            placeholder="Enter Roll Number">
                                        @error('roll_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" name="student_name" value="{{ old('student_name') }}"
                                            class="form-control @error('student_name') is-invalid @enderror"
                                            placeholder="Enter Student Name">

                                        @error('student_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="date" name="dob" value="{{ old('dob') }}"
                                            class="form-control @error('dob') is-invalid @enderror">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" name="parent_name" value="{{ old('parent_name') }}"
                                            class="form-control @error('parent_name') is-invalid @enderror"
                                            placeholder="Enter Father Name">
                                        @error('parent_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Father Contact</label>
                                        <input type="text" name="parent_contact" value="{{ old('parent_contact') }}"
                                            class="form-control @error('parent_contact') is-invalid @enderror"
                                            placeholder="Enter Contact Numebr">
                                        @error('parent_contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Admission Date</label>
                                        <input type="date" name="admission_date" value="{{ old('admission_date') }}"
                                            class="form-control @error('admission_date') is-invalid @enderror">
                                        @error('admission_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ old('address') }}"
                                            class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter Address">
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">
                                Save Student
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
