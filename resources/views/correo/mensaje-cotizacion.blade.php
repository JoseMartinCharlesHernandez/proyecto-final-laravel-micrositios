<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      table, th, td {
        border: 1px solid black;
      }
    </style>
</head>
<body>
    <label for="">cotización de <b style="color: blue">{{$micrositio->nombre}}</b></label><br><br>
    <table >
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Total</th>
        </tr>
        <tr>
          <td>{{$producto->nombre}}</td>
        <td>{{$cantidad}}</td>
        <td>${{$total}}</td>
        </tr>
      </table>
</body>
</html>