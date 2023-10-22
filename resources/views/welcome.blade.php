<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @dd($EventManager);
            {{-- @foreach ($EventManagers as $EventManager)
            <tr>
                <td>{{ $EventManager->first_name }}</td>
                <td>{{ $EventManager->email }}</td>
                <td>{{ $EventManager->status }}</td>
                {{-- <td><a href="http://" ></a></td>

            </tr>
            @endforeach --}}
        </tbody>
    </table>
    
</body>
</html>
