@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <!-- Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Teacher</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('teachers.index') }}">Teachers</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Teacher</li>
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
                        <h3 class="card-title">Edit Teacher</h3>
                    </div>



                    <form action="{{ route('teachers.update',  $teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- Subject Name -->
                                    <div class="form-group">
                                        <label>Teacher Name</label>
                                        <input type="text" name="teacher_name" value="{{ old('teacher_name' , $teacher->name) }}"
                                            class="form-control @error('teacher_name') is-invalid @enderror"
                                            placeholder="Enter Teacher name">

                                        @error('teacher_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Subject Code -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('email' ,  $teacher->email) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Teacher Email">

                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone' ,  $teacher->phone) }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter Teacher Phone Number">

                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                 <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" value="{{ old('address' ,  $teacher->address) }}"
                                            class="form-control @error('address') is-invalid @enderror"
                                            placeholder="Enter Teacher Address">

                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary float-right">
                                Update Teacher
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
