<!DOCTYPE html>
<html lang="en">

    <!-- Head -->
  <head>
    @include('user/layouts/head')
  </head>

  <body>
    <!-- Header -->
    @include('user/layouts/header')

    <!-- Main Content -->
    @yield('main')

    <!-- Footer -->
    @include('user/layouts/footer')
    
  </body>

</html>
