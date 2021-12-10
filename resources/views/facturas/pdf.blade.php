<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura #{{ $factura->numero_factura }}</title>
    <style>
        table, tr, td {
            border: solid 0.5px #353535 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse; 
            border: none !important;
        }

        td {
            padding: 2px 5px 2px 5px;
        }

        @page {
            font-size: 16px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-top: 3cm;
            margin-left: 2cm:
        }

        .text-right {
            text-align: right;
        }

        .w-80 {
            width: 80px;
        }
    </style>
</head>
<body>
    <b class="text-right">{{ $factura->created_at->format('d/m/Y g:i A') }}</b><br>
    <b>Factura #{{ $factura->numero_factura }}</b>
    <br><br>
    <table cellspacing="2px">
        <tr>
            <td><b>Producto</b></td>
            <td><b>Cantidad</b></td>
            <td><b>Precio</b></td>
            <td><b>Subtotal</b></td>
        </tr>
        @foreach ($factura->productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td  w-80">{{ $producto->pivot->cantidad }}</td>
                <td class="text-right">${{ number_format($producto->pivot->precio, 0, ',', '.') }}</td>
                <td class="text-right">${{ number_format($producto->pivot->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr>
            <td class="text-right" colspan=3><b>Total</b></td>
            <td class="text-right"><b>${{ number_format($factura->total, 0, ',', '.') }}</b></td>
        </tr>
    </table>
</body>
</html>