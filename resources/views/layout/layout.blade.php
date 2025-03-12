<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<html>
<head>
    <title>Projekat @yield('title')</title>
    <style>
        html,body {
            font-size: 15px;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
        .navbar {
            background: url('{{ asset("img/test.jfif") }}') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .navbar::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(128, 128, 128, 0.5); /* Poluprovidna siva boja */
            backdrop-filter: blur(8px); /* Blur efekat */
            z-index: 0;
        }
        .navbar .container-fluid,
        .navbar .navbar-brand,
        .navbar .navbar-nav,
        .navbar .nav-link,
        .navbar .dropdown-menu {
            position: relative;
            z-index: 1;
        }
        .nav-link {
            border-radius: 5px;
            background-color: #ffffff;
            color: #333333 !important;
            padding: 8px 12px;
            margin: 0 5px;
            transition: background 0.3s ease;
        }
        .nav-link:hover {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #fff !important;
        }
        .dropdown-item {
            border-radius: 5px;
            transition: background 0.3s ease;
        }
        .dropdown-item:hover {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            color: #fff;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<x-layouts.navigation/>

<!-- Centralni kontejner se rasteže -->
<div class="flex-grow-1 backGround">
    @yield('content')
</div>

<x-layouts.footer/>
</body>
</html>


