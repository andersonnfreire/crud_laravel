<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title or 'Painel Curso'}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{url('asset/painel/icons/style.css')}}">
        <link rel="stylesheet" href="{{url('asset/painel/icons/css/all.css')}}"><!--load all styles -->
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>