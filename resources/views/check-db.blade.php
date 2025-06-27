<!DOCTYPE html>
<html>
<head>
    <title>Verificación de Conexión DB</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-top: 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 8px; }
        th { background-color: #eee; }
    </style>
</head>
<body>

    <h1>✅ Conexión exitosa a la base de datos</h1>

    <h2>Usuarios</h2>
    <table>
        <tr>
            @foreach ($users->first() ?? [] as $key => $val)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
        @foreach ($users as $user)
            <tr>
                @foreach ($user as $val)
                    <td>{{ $val }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    <h2>Productos</h2>
    <table>
        <tr>
            @foreach ($products->first() ?? [] as $key => $val)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
        @foreach ($products as $item)
            <tr>
                @foreach ($item as $val)
                    <td>{{ $val }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    <h2>Ventas</h2>
    <table>
        <tr>
            @foreach ($sales->first() ?? [] as $key => $val)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
        @foreach ($sales as $sale)
            <tr>
                @foreach ($sale as $val)
                    <td>{{ $val }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

    <h2>Detalles de venta</h2>
    <table>
        <tr>
            @foreach ($details->first() ?? [] as $key => $val)
                <th>{{ $key }}</th>
            @endforeach
        </tr>
        @foreach ($details as $d)
            <tr>
                @foreach ($d as $val)
                    <td>{{ $val }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>

</body>
</html>
