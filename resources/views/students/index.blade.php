@extends('layouts.app')

@section('content')

<h2>Students List</h2><BR><br>

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('students.create') }}" class="btn btn-primary">Create new Student</a>

    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
</div>
<br>@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<form action="{{ route('students.index') }}" method="GET" class="mb-3 d-flex gap-2">

    <input type="text" name="search" class="form-control "
           placeholder="Search record through name & email"
           value="{{ request('search') }}">

    <select name="course" class="form-select w-25">
        <option value="">All Courses</option>
        <option value="B.tech" {{ request('course')=='B.tech' ? 'selected' : '' }}>B.Tech</option>
        <option value="BCA" {{ request('course')=='BCA' ? 'selected' : '' }}>BCA</option>
        <option value="B.com" {{ request('course')=='B.com' ? 'selected' : '' }}>B.com</option>
        <option value="M.com" {{ request('course')=='M.com' ? 'selected' : '' }}>M.com</option>
    </select>

    <button type="submit" class="btn btn-primary">Apply</button>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>

</form>

<!-- bulk delete -->
<form id="bulkDeleteForm" action="{{ route('students.bulkDelete') }}" method="POST">
    @csrf
    @method('DELETE')
</form>

    <button type="submit" form="bulkDeleteForm" class="btn btn-danger mb-3"
        onclick="return confirm('Are you sure you want to delete selected students?')">
        Delete Selected
    </button>

    <table class="table table-bordered mt-2">
        <thead>
            <tr>
             <th><input type="checkbox" id="select-all"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Image</th>
                <th>Created At</th>
                <th>Edit</th>
                <th>Delete</th>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach($students as $student)
            <tr>

                <td>
                   <input type="checkbox" name="ids[]" value="{{ $student->id }}" form="bulkDeleteForm">
                </td>
                <td>{{ $student->id}}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->course }}</td>
                <td>
                    <img src="{{ asset('uploads/students/'.$student->profile_img) }}"
                        alt="Image"
                        width="45" height="45"
                        style="object-fit: cover; border-radius: 5px;">
                </td>

                <td>{{ $student->created_at->format('d-m-y ') }}</td>

                <td>
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-info btn-sm">Edit</a>
                </td>
                <td>
                 <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"onclick="return confirm('Are you sure you want to delete student?')">Delete

                    </button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}

<a href="{{ route('students.export', request()->all()) }}" class="btn btn-success">
    Export to PDF
</a>

    <script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
    </script>

@endsection
