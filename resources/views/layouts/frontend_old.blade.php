<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 5 Website Example</title>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  </style>
  @yield('extra_css')
</head>
<body>
@include('_front.parts.header')

@yield('main_content')

<div class="mt-5 p-4 bg-dark text-white text-center">
@include('_front.parts.footer')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script type="text/javascript">

     lazyload();

     window.onload = (function (el) {
         lazyload();
     });

     window.onscroll = function (el) {
         lazyload();
     };

     function lazyload() {
         var lazyImage = document.getElementsByClassName('lazy');

         for (var i = 0; i < lazyImage.length; i++) {
             if (elementInViewport(lazyImage[i])) {
                 lazyImage[i].setAttribute('src', lazyImage[i].getAttribute('data-src'));
             }
         }
     }

     function elementInViewport(el) {
         var rect = el.getBoundingClientRect();
         return (
             rect.top >= 0 &&
             rect.left >= 0 &&
             rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
             rect.right <= (window.innerWidth || document.documentElement.clientWidth)
         );
     }

 </script>
 
@yield('extra_js')

</body>
</html>