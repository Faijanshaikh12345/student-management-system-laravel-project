@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Select Exam & Subject</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Marks</li>
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
                    <h3 class="card-title">Choose Exam and Subject</h3>
                </div>

                <form action="{{ route('marks.store') }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="row">

                            {{-- Exam --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Exam Name</label>
                                    <select name="exam_id"
                                        class="form-control @error('exam_id') is-invalid @enderror" required>
                                        <option value="">Select Exam</option>
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('exam_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Subject --}}
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Subject Name</label>
                                    <select name="subject_id"
                                        class="form-control @error('subject_id') is-invalid @enderror" required>
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

                        </div>
                    </div>

                    <div class="card-footer">
                         <a href="{{ route('marks.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary float-right">
                            Show Students
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
    }, 10000);
</script>
@endpush