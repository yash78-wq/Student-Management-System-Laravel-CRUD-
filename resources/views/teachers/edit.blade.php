@extends('layouts.app')
@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg p-4" style="width: 30rem; border-radius: 12px;">

        <h2 class="text-center mb-4">Edit teacher Details</h2>

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

        <form action="{{ route('teachers.update',$teacher->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $teacher->name) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $teacher->email) }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone', $teacher->phone) }}"
                >
            </div>

             <div class="mb-3">
                <label class="form-label">Specialization</label>
                <input
                    type="text"
                    name="specialization"
                    class="form-control"
                    value="{{ old('specialization', $teacher->specialization) }}"
                >
            </div>
            <div class="mb-3">
                <label class="form-label">Salary</label>
                <input
                    type="text"
                    name="salary"
                    class="form-control"
                    value="{{ old('salary', $teacher->salary) }}"
                >
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Details</button><br><br>
        </form>

        <a href="{{ route('teachers.index') }}"class="btn btn-secondary"><- Go back</a>

    </div>
</div>

@endsection
