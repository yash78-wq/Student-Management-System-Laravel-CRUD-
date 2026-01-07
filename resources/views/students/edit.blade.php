@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg p-4" style="width: 30rem; border-radius: 12px;">

        <h2 class="text-center mb-4">Edit Student Details</h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $student->name) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $student->email) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone', $student->phone) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile_img" class="form-control">
            </div>

           <div class="mb-3">
                <label for="course" class="form-label">Course:</label>
                <select id="course" name="course" class="form-select">
                    <option value="">-- Select Course --</option>
                    <option value="B.Tech" {{ old('course', $student->course) == 'B.Tech' ? 'selected' : '' }}>B.Tech</option>
                    <option value="BCA" {{ old('course', $student->course) == 'BCA' ? 'selected' : '' }}>BCA</option>
                    <option value="B.com" {{ old('course', $student->course) == 'B.com' ? 'selected' : '' }}>B.com</option>
                    <option value="M.com" {{ old('course', $student->course) == 'M.com' ? 'selected' : '' }}>M.com</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary w-100">Update Details</button><br><br>
        </form>

        <a href="{{ route('students.index') }}"class="btn btn-secondary"><- Go back</a>

    </div>
</div>

@endsection
