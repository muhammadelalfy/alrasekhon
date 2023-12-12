
<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{__('app')}}</title>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="RoQaY Company" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,  user-scalable=0" name="viewport" />
    <meta name="description" content="RoQaY Website" />
    <meta name="keywords" content="RoQaY Website " />
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}" type="image/x-icon" sizes="32*32" />
    <!-- bootstrap 5 id english -->
    @if(app()->getLocale() == 'ar')
        <!-- bootstrap 5 if arabic -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.rtl.min.css" integrity="sha512-ltIFivbYEeV9dNzcYLxBKC2hPQ0l9K2/Ws8R5GsMkxANKtMigmsjzTUUej7iH5NwGNnD070lrycDq5OJlDyb1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @else

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" async />
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap" rel="stylesheet" async />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.css" id="theme-styles">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('UI/assets/css/style.css')}}" async />
    @vite(['resources/app/app.js','resources/sass/app.scss'])
</head>


<!-- todo If Arabic -->
<!-- Add dir="rtl" class="rtl"-->
<!-- class="color-horizontal" if menu colored || class="color-header" if header colored-->


<body @if(app()->getLocale() == 'ar') dir="rtl" @endif
    class='main-body @if(app()->getLocale() == 'ar') rtl @endif'>

    <div id="app"></div>

</body>

</html>
