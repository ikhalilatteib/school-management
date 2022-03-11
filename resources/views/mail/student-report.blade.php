<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<h2>HTML Table</h2>

<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>School</th>
        <th>Campus</th>
        <th>Country</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->campus->school->name}}</td>
            <td>{{$student->campus->name}}</td>
            <td>{{$student->campus->country->name}}</td>
        </tr>
    @endforeach

</table>

</body>
</html>
