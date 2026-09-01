<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makka Construction</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('public/front/css/style.css')}}">
      </head>
      <body>
            <!--=====================================-->
            @include('front.layouts.header')

            @yield('content')
         <!--=====================================-->
         <!--=====================================-->
         <!--=     Footer Section Area Start     =-->
         <!--=====================================-->
         @include('front.layouts.footer')
  </body>
</html>