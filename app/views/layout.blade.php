<?php 

    $assets = [
        'javascript' => [
            'assets/vendor/jquery/dist/jquery.min.js',
            'assets/vendor/jquery-form/jquery.form.js',
            'assets/vendor/speakingurl/speakingurl.min.js',
            'https://www.google.com/jsapi',
            'assets/js/scripts.min.js',
        ],
        'stylesheet' => [
            'assets/css/style.min.css',
        ],
    ];

?>

<!doctype html>
<html lang="{{{ Config::get('app')['locale'] }}}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Publi CMS {{{ isset($pageTitle) ? "|" . $pageTitle : "" }}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">

        @foreach ($assets['stylesheet'] as $asset)
            {{ HTML::style($asset) }}
        @endforeach

        <script> var BASEURL = "{{ URL::to('/') }}"; </script>
    </head>
    <body class="{{ $pageClass or '' }}">

        @if(Sentry::check())
            @include('partials.menu')
        @endif

        @yield('content')
    
        @if(Sentry::check())
            <footer class="footer">
                <div class="container">
                    <span class="wrap">
                        <span>
                            Developed by <a href="http://publibrand.com.br/">Publibrand</a> 
                        </span>
                        <span class="divider">-</span> 
                        <span>
                            Fork us on <a class="github" href="http://github.com/publibrand/cms/">Github</a>
                        </span>
                    </span>
                </div>
            </footer>
        @endif

        @foreach ($assets['javascript'] as $asset)
            {{ HTML::script($asset) }}
        @endforeach
        
    </body>
</html>