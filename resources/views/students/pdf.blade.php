<h2>Students Report</h2>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Course</th>
    </tr>
    </thead>

    <tbody>
    @foreach($students as $student)
    <tr>
        <td>{{ $serialNo++ }}</td>
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
        <td>{{ $student->created_at }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
