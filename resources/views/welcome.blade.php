<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
       
    </head>
    <body class="antialiased">
        <h1>Olá mundo, LARAVEL!!!</h1>
        <br>
        <a href="{{route('curso.index')}}">Listar Cursos</a> <br>
        <a href="{{route('curso.create')}}">Cadastrar Curso</a>
    </body>
</html>
