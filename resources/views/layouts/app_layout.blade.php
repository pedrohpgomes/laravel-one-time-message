<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}}</title>

        <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class='text-center my-5'>{{config('app.name')}}</h1>

                    @yield('content')

                    <div class="text-center my-5">
                        <small>Created by Pedro Henrique &copy; {{date('Y')}}</small>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>