<!DOCTYPE html>
<html>
<head>
    <title>User List PDF</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #87CEFA; /* Light sky blue */
            text-align: left;
            padding: 8px;
            border: 1px solid #999;
            font-size: 13px;
        }

        td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 12px;
        }
    </style>
</head>

<body>

<h3>User List</h3>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->first_name }}</td>
            <td>{{ $u->last_name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->is_active ? 'Active' : 'Inactive' }}</td>
            <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d-m-Y h:i A') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
