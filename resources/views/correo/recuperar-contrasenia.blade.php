<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Hola {{$user->name}}</p>
    <p>la contraseña que se registró con tu email: {{$user->email}} ha cambiado.</p>
    <p>la nueva contraseña es: {{$password}}</p>
    <p>Inicia sesión y cambiala.</p>
</body>
</html>