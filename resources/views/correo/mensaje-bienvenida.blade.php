<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h3 style="color: blue">Bienvenido!</h3>
    <p>Te damos la bienvenida <b style="color: blue"> {{ $user->name}}</b>!</p>
    <p>te has registrado como <b style="color: cornflowerblue">{{ $user->type==2 ? 'empreasrio' : 'usuario'}}</b></p>
    <p> para inciar sesión usa tu correo: <b style="color: green">{{$user->email}}</b></p>
    <p>y tu contraseña: <b style="color: coral">{{$password}}</b></p>
</body>
</html>