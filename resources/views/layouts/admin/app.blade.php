<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Damietta IP Portal | @yield('title')</title>
    <link rel="stylesheet" href={{asset('assets/admin/css.css')}}>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
          <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">
    

    
</head>

<body>


<!-- =============================================================
     MOBILE SIDEBAR TOGGLE
============================================================= -->

<input type="checkbox" id="mobileSidebarToggle" class="mobile-toggle">

<label for="mobileSidebarToggle" class="mobile-overlay"></label>


<!-- =============================================================
     SIDEBAR
============================================================= -->

@include('layouts.admin.sidebar')


<!-- =============================================================
     MAIN WRAPPER
============================================================= -->

<div class="main-wrapper">


    <!-- =========================================================
         NAVBAR
    ========================================================= -->

 @include('layouts.admin.header')


    <!-- =========================================================
         CONTENT
    ========================================================= -->

   @yield('body')
</div>


<!-- =============================================================
     ADD USER CSS-ONLY MODAL
============================================================= -->

@include('layouts.admin.adduser')
<!-- Bootstrap 5 JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>