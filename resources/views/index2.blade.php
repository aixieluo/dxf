<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body>
<div id="app">
    <form action="http://dxf.ssl/api/upload" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" value="提交">
    </form>
</div>
</body>
</html>
