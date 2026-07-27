@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Student</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('students.index') }}">Students</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Student</li>
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
                        <h3 class="card-title">Edit Student</h3>
                    </div>



                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    {{-- class name  --}}
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            <option value="">Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
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
                                        <input type="text" name="roll_number"
                                            value="{{ old('roll_number', $student->roll_number) }}"
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
                                        <input type="text" name="student_name"
                                            value="{{ old('student_name', $student->name) }}"
                                            class="form-control @error('student_name') is-invalid @enderror"
                                            placeholder="Enter Student Name">

                                        @error('student_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>

                                            <option value="male"
                                                {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>
                                                Male
                                            </option>

                                            <option value="female"
                                                {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>
                                                Female
                                            </option>

                                            <option value="other"
                                                {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>

                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="date" name="dob" value="{{ old('dob', $student->dob) }}"
                                            class="form-control @error('dob') is-invalid @enderror">
                                        @error('dob')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input type="text" name="parent_name"
                                            value="{{ old('parent_name', $student->parent_name) }}"
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
                                        <input type="text" name="parent_contact"
                                            value="{{ old('parent_contact', $student->parent_phone) }}"
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
                                        <input type="date" name="admission_date"
                                            value="{{ old('admission_date', $student->admission_date) }}"
                                            class="form-control @error('admission_date') is-invalid @enderror">
                                        @error('admission_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address"
                                            value="{{ old('address', $student->address) }}"
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
                                Update Student
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

            function loadSections(class_id, selected_section = null) {
                if (class_id) {
                    $.ajax({
                        url: "/get-sections/" + class_id,
                        type: "GET",
                        success: function(data) {

                            $('#section_id').empty();
                            $('#section_id').append('<option value="">Select Section</option>');

                            $.each(data, function(key, section) {
                                let selected = (selected_section == section.id) ? 'selected' :
                                    '';
                                $('#section_id').append(
                                    '<option value="' + section.id + '" ' + selected + '>' +
                                    section.name + '</option>'
                                );
                            });
                        }
                    });
                }
            }

            // ✅ On class change
            $('#class_id').change(function() {
                let class_id = $(this).val();
                loadSections(class_id);
            });

            // ✅ VERY IMPORTANT — when edit page loads
            let currentClass = "{{ $student->class_id }}";
            let currentSection = "{{ $student->section_id }}";

            loadSections(currentClass, currentSection);
        });
    </script>
@endpush
