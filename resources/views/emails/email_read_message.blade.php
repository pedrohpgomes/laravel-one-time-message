<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <h4>{{config('app.name')}}</h4>
        <p>Você tem uma mensagem.</p>
        <p>IMPORTANTE: Essa mensagem só poderá ser lida uma única vez.</p>
        <p><a href="{{route('main_read', ['purl'=>$purl_code] )}}">Ver mensagem</a></p>
    </body>
</html>