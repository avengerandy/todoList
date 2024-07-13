<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Microsoft JhengHei';
            }
        </style>
    </head>

    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a href="/"><span class="navbar-brand mb-0 h1">Todo</span></a>
                <a href="/create"><span class="btn btn-primary">Create Todo</span></a>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
