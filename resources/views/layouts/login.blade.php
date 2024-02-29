<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
    
    {{-- adicionado bootstrap com vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js']);    

    <title>Laravel</title>
</head>
<body class="bg-primary">
    @yield('content')
</body>
</html>