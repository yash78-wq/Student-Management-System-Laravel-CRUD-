@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg p-4" style="width: 30rem; border-radius: 12px;">

        <h2 class="text-center mb-4">Create New Student</h2>

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

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    placeholder="Enter your name"
                >
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email"
                >
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    class="form-control"
                    placeholder="Enter your phone"
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
                    <option value="B.Tech">B.Tech</option>
                    <option value="BCA">BCA</option>
                    <option value="B.com">B.com</option>
                    <option value="M.com">M.com</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Create Student</button>
            <br><br>
        </form>
        <a href="{{ route('students.index') }}"class="btn btn-secondary"><- Go back</a>
    </div>
</div>

@endsection
