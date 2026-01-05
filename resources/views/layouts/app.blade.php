<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'GoErudite')</title>

    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    @include('partials.header-assets')
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

@stack('scripts')

</body>
</html>
