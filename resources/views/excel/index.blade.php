<table>

    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Is Admin</th>
            <th>Gender</th>
            <th>Phone</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin == 1 ? 'Admin' : 'User' }}</td>
            <td>{{ $user->gender == 1 ? 'Nam' : 'Nữ' }}</td>
            <td>{{ $user->phone }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
