<!DOCTYPE HTML>
<html style="height:800px">
    <head>
        <title>@yield('title')</title>
    </head>
    <body style="height:550px;background-image:url({{env("PRODUCTION_URL",env("APP_URL")) }}public/images/bg01.jpg); margin:0px;">
        <div class="container" style="position: relative;max-width: 768px;margin: auto;height: 100%;background-color: #f7f5f2f2;padding: 8px;box-sizing: border-box;color: #58bd2e;text-align: center;">
          <div class="logo" style="width: 30%;margin: 10px auto;">
            <img width="100%" src="{{env("PRODUCTION_URL",env("APP_URL"))}}public/images/logo.png" alt="">
          </div>
          <div class="hr" style="min-height: 2px;background-color: #4a8233;margin: 2px 0px;"></div>
            @yield('content')
            <div class="hr bottom" style="min-height: 2px;background-color: #4a8233;margin: 2px 0px;"></div>
        </div>
    </body>
</html>
