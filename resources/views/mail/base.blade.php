<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <style media="screen">
      .container{
        max-width: 1024px;margin: auto;
      }
    </style>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
