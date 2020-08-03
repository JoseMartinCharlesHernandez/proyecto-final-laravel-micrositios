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
        <p style="color: blue"><b>Hola</b> {{$user->name}}</p>
        <p>la contraseña que se registró con tu email: <b style="color: cornflowerblue">{{$user->email}}</b> ha cambiado.</p>
        <p>la nueva contraseña es: <b style="color: coral">{{$user->password}}</b></p>
        <a type="button" href="{{route('login')}}" class="btn btn-success">Iniciar Sesión</a>
    </body>
</html>