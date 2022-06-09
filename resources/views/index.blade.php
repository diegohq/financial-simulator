<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simuladores de investimento</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}" defer></script>

    @if(App::environment('production'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-85ZMZMW04P"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-85ZMZMW04P');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5507757504814188"
            crossorigin="anonymous"></script>
    @endif

</head>
<body>

    <div class="container">
        <div class="row mt-3">

            <div class="col-md-3"><!-- AD --></div>
            <div class="col-md-6 col-12">
                <h1 class="mb-3">Simuladores de investimento</h1>
                <div id="simulator"></div>
            </div>
            <div class="col-md-3"><!-- AD --></div>

        </div>

        <div class="mt-3">

        </div>

    </div>

</body>
</html>
