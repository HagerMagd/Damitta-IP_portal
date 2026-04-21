<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
   @include('layouts.frontend_layouts.header')
{{-- body --}}
   @yield('body')

    <!-- Footer -->
   @include('layouts.frontend_layouts.footer')
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
