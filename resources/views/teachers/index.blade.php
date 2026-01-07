
@extends('layouts.app')

@section('content')

<h2>Teachers List</h2><br>
<a href="{{ route('students.index') }}" class="btn btn-secondary">View students </a>

<BR><br>

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('teachers.createForm') }}" class="btn btn-primary">Create new Teacher</a>

    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
</div>
<br>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Specialization</th>
            <th>Salary</th>
            <th>Status</th>
            <th>Actions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr>
            <td>{{ $serialNo ++ }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>{{ $teacher->specialization }}</td>
            <td>{{ $teacher->salary }}</td>
            <td>
                 <form action="{{ route('teachers.updateStatus', $teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $teacher->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                 </form>
            </td>
            <td>
                <a href="{{ route('teachers.edit',$teacher->id) }}"class="btn btn-info"> Edit </a></td>
                <td>
                <form action="{{ route('teacher.destroy',$teacher->id) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                 <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Are you sure you want to delete this student?')">
                    Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection

