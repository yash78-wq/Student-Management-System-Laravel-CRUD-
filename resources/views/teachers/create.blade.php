@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg p-4" style="width: 30rem; border-radius: 12px;">

        <h2 class="text-center mb-4">Create New Teacher</h2>

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

        <form action="{{ route('teachers.store') }}" method="POST">
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
                <label for="specialization" class="form-label">Specialization</label>
                <input
                    type="text"
                    id="specialization"
                    name="specialization"
                    class="form-control"
                    placeholder="Enter specialization"
                >
            </div>

               <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input
                    type="decimal"
                    id="salary"
                    name="salary"
                    class="form-control"
                    placeholder="Enter salary"
                >
            </div>


            <button type="submit" class="btn btn-success w-100">Create Student</button>
            <br><br>
        </form>
        <a href="{{ route('teachers.index') }}"class="btn btn-secondary"><- Go back</a>
    </div>
</div>

@endsection
