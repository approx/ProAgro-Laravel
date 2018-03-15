<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <style media="screen">
      .container{
        position: relative;
        max-width: 768px;margin: auto;
        height: 100%;
        background-color: #f7f5f2f2;
        padding: 8px;
        box-sizing: border-box;
        color: #58bd2e;
        text-align: center;
      }
      .logo{
        width: 30%;
        margin: 10px auto;
      }
      .hr{
        min-height: 2px;
        background-color: #4a8233;
        margin: 2px 0px;
      }
      .bottom{
        position: absolute;
        left: 8px;
        right: 8px;
        bottom: 80px;
      }
      body{
        margin: 0px;
        background-image: url("{{ env("PRODUCTION_URL",env("APP_URL")) }}/public/images/bg01.jpg");
      }
    </style>
    @yield('style')
    <body>
        <div class="container">
          <div class="logo">
            <img width="100%" src="{{env("PRODUCTION_URL",env("APP_URL"))}}/public/images/logo.png" alt="">
          </div>
          <div class="hr"></div>
          <div class="hr bottom"></div>
            @yield('content')
        </div>
    </body>
</html>
