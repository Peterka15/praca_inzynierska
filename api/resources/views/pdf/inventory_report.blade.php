<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
    </style>
    <title>Raport sprzętu</title>
</head>
<body>
<h1>Raport sprzętu</h1>
<table>
    <thead>
        <tr>
            <th>Nazwa</th>
            <th>Kategoria</th>
            <th>Ilość</th>
            <th>Jednostka</th>
            <th>Dostępność</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inventories as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->unit->name }}</td>
                <td>{{ $item->available ? 'Tak' : 'Nie' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
