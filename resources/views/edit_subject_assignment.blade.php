@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Assign Subject To Teacher</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('subjectAssignments.index') }}">Subject Assignments</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Assignments</li>
                        </ol>
                    </div>

                </div>
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
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Subject Assignment</h3>
                    </div>

                    <form action="{{ route('subjectAssignments.update', $assignment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row">

                                {{-- Teacher --}}
                                <div class="col-12 col-md-3">
                                    <label>Teacher</label>
                                    <select name="teacher_id" class="form-control">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                {{ $assignment->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Subject --}}
                                 <div class="col-12 col-md-3">
                                    <label>Subject</label>
                                    <select name="subject_id" class="form-control">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Class --}}
                                 <div class="col-12 col-md-3">
                                    <label>Class</label>
                                    <select name="class_id" id="class_id" class="form-control">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ $assignment->class_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Section --}}
                                 <div class="col-12 col-md-3">
                                    <label>Section</label>
                                    <select name="section_id" id="section_id" class="form-control">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ $assignment->section_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('subjectAssignments.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#class_id').change(function() {
            var class_id = $(this).val();

            $.ajax({
                url: "{{ url('/get-sections') }}/" + class_id,
                type: 'GET',
                success: function(data) {
                    $('#section_id').empty();

                    $.each(data, function(key, section) {
                        $('#section_id').append(
                            '<option value="' + section.id + '">' + section.name +
                            '</option>'
                        );
                    });
                }
            });
        });
    </script>
@endpush
