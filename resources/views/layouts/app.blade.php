<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $settings = \App\Models\Setting::find('1');
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if($settings->site)
    <title>Login | {{ $settings->site_title }}</title>
    @endif
    @if($settings->favicon)
    <link rel="shortcut icon" href="/{{$settings->favicon}}">
    @endif 

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body {
            font-family: 'Lato';
            margin-top: 10%;
        }

        .fa-btn {
            margin-right: 6px;
        }
        
        #app-layout{
    background-color: #eee;
    background: url(/img/bg_login2.jpg) no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.welcome_login{
    display: block;
    text-align: center;
    color: #fff;
    font-size: 35px;
    font-family: sans-serif;
}

.welcome_url{
    font-family: Helvetica Neue, Helvetica, Arial, SolaimanLipi, sans-serif, "SolaimanLipiNormal" !important;
    font-size: 35px;
    color: #70c3c3;
}

.welcome_url:hover{ 
    color: #70c3c3;
    text-decoration: none;
}

.panel {
    margin-bottom: 20px;
    background-color: #212b5b69;
}


.brand_login_image .brand_icon{
    position: absolute;
    top: 0;
    left: 0;
    width: 210px;
    opacity: .6;
}

.brand_login_image .brand_icon_d{
    position: absolute;
    height: 154px;
    left: 5px;
    bottom: 5px;
    opacity: .4;
}


@media (max-width: 800px){
    .brand_login_image .brand_icon {
    width: 125px;
}

}
    </style>
</head>
<body id="app-layout" style="background-color: #eee">
    @yield('content')
    <div class="brand_login_image">
        <img class="brand_icon" src="/img/brand_icon.png" />
        <img class="brand_icon_d hidden-xs hidden-sm" src="/img/brand_icon_d.png" />
    </div>
    <!-- JavaScripts -->
   <script src="https://cms.godevsbd.com/assets/js/vendor/jquery-3.5.1.min.js"></script>
</body>
</html>
