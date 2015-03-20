<?php 

    $assets = [
        'javascript' => [
            'assets/vendor/jquery/dist/jquery.min.js',
            'assets/vendor/jquery-form/jquery.form.js',
            'assets/vendor/speakingurl/speakingurl.min.js',
            'assets/vendor/trumbowyg/dist/trumbowyg.min.js',
            'assets/vendor/datetimepicker/jquery.datetimepicker.js',
            'assets/vendor/selectize/dist/js/standalone/selectize.min.js',
            'assets/vendor/jQuery-Mask-Plugin/dist/jquery.mask.min.js',
            'assets/vendor/jquery-ui/jquery-ui.min.js',
            'https://www.google.com/jsapi',
            'assets/js/scripts.min.js',
        ],
        'stylesheet' => [
            'assets/vendor/trumbowyg/dist/ui/trumbowyg.min.css',
            'assets/vendor/datetimepicker/jquery.datetimepicker.css',
            'assets/vendor/selectize/dist/css/selectize.default.css',
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

        <script>
			var BASEURL = "{{ URL::to('/') }}";
			var LANG = JSON.parse('{{ json_encode(Lang::get('messages')) }}') ;
		</script>
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
                            {{ Lang::get('messages.developed_by') }} <a href="http://publibrand.com.br/">Publibrand</a> 
                        </span>
                        <span class="divider">-</span> 
                        <span>
                            {{ Lang::get('messages.fork_us_on') }} <a class="github" href="http://github.com/publibrand/cms/">Github</a>
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