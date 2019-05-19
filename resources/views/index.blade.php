<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M & E</title>
    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />
    <meta name="csrf-token" value="{{ csrf_token() }}" />
</head>
<body>
<div id="app">
    <app></app>
</div>
<!-- Core JS files -->
{{--<script type="text/javascript" src="/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="/assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/loaders/blockui.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/ui/nicescroll.min.js"></script>
<script type="text/javascript" src="/assets/js/plugins/ui/drilldown.js"></script>--}}
<!-- /core JS files -->

<script src="https://ckeditor.com/apps/ckfinder/3.4.5/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>

<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>