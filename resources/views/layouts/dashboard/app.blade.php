<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    {{-- Google Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>

    <div class="dashboard">

        @include('layouts.dashboard.sidebar')

        <div class="main-content">

            @include('layouts.dashboard.header')

            <div class="content">
                @include('components.alert')
                @yield('content')

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>




    @stack('js')
    <script>

function closeFlash(){

    const flash = document.getElementById('flash-message');

    if(!flash) return;

    flash.classList.add('fade-out');

    setTimeout(() => {
        flash.remove();
    },500);

}

setTimeout(() => {

    closeFlash();

},4000);

</script>
</body>



</html>