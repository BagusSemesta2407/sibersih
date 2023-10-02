<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <title>SIBERSIH - Sistem Informasi Kebersihan</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets-lp/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/assets-lp/assets/css/fontawesome.css">
    <link rel="stylesheet" href="/assets-lp/assets/css/templatemo-digimedia-v3.css">
    <link rel="stylesheet" href="/assets-lp/assets/css/animated.css">
    <link rel="stylesheet" href="/assets-lp/assets/css/owl.css">
    <!--

TemplateMo 568 DigiMedia

https://templatemo.com/tm-568-digimedia

-->
</head>

<body>

    @yield('content-lp')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © {{ date('Y') }} Kecamatan Subang.
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="/assets-lp/vendor/jquery/jquery.min.js"></script>
    <script src="/assets-lp/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets-lp/assets/js/owl-carousel.js"></script>
    <script src="/assets-lp/assets/js/animation.js"></script>
    <script src="/assets-lp/assets/js/imagesloaded.js"></script>
    <script src="/assets-lp/assets/js/custom.js"></script>
    @yield('script')
</body>

</html>
