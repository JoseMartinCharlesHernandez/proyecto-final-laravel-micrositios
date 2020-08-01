<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <p>Hola {{$user->name}}</p>
    <p>la contraseña que se registró con tu email: {{$user->email}} ha cambiado.</p>
    <p>la nueva contraseña es: {{$password}}</p>
    <p>Inicia sesión y cambiala.</p>
    <button type="button" class="btn btn-success">Restaurar</button>
</body>
</html>