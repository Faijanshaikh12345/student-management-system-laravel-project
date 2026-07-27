@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Subject</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('subjects.index') }}">Subjects</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Subject</li>
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
                        <h3 class="card-title">Add New Subject</h3>
                    </div>



                    <form action="{{ route('subjects.update' , $subject->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- Subject Name -->
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" name="subject_name" value="{{ old('subject_name' , $subject->name) }}"
                                            class="form-control @error('subject_name') is-invalid @enderror"
                                            placeholder="Enter subject name">

                                        @error('subject_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>



                                <!-- Subject Code -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Subject Code</label>
                                        <input type="text" name="subject_code" value="{{ old('subject_code' , $subject->code) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Subject Code">
                                        @error('subject_code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">
                                Update Subject
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
