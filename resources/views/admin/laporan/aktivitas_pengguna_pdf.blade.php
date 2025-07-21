<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Aktivitas Pengguna</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; font-size: 12px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Aktivitas Pengguna</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $user)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
