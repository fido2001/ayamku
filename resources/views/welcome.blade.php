<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,300&display=swap");
    body {
    font-family: 'Poppins', sans-serif;
    }

    .head__custom-nav .navbar-brand img {
    width: 18px;
    height: 18px;
    }

    .head__custom-nav .navbar-brand span {
    font-weight: 700;
    font-size: 22px;
    margin-left: 10px;
    }

    .head__custom-nav button {
    padding: 0;
    }

    .head__custom-nav button span img {
    width: 45px;
    }

    .head__custom-nav #navbarNav .navbar-nav .nav-item .nav-link {
    color: #000;
    font-weight: 400;
    padding: 8px 15px;
    white-space: nowrap;
    -webkit-transition: 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
    transition: 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
    }

    .head__custom-nav #navbarNav .navbar-nav .nav-item .nav-link:hover {
    color: lightcoral;
    }

    .custom-section {
    width: inherit;
    padding: 40px 0;
    }

    @media screen and (max-width: 991.98px) {
    .custom-section {
        -webkit-box-orient: vertical;
        -webkit-box-direction: reverse;
            -ms-flex-direction: column-reverse;
                flex-direction: column-reverse;
    }
    }

    .custom-section .col-lg-4 {
    margin-top: 100px;
    }

    .custom-section .col-lg-4 h2 {
    font-weight: 700;
    font-size: 63px;
    color: #000;
    margin-bottom: 0;
    line-height: 1;
    white-space: nowrap;
    }

    .custom-section .col-lg-4 h3 {
    font-weight: 300;
    font-size: 64px;
    color: #000;
    line-height: 1;
    }

    .custom-section .col-lg-4 p {
    color: #000;
    font-size: 14px;
    margin-top: 30px;
    }

    .custom-section .col-lg-4 a {
    display: inline-block;
    padding: 8px 22px;
    color: #fff;
    background-color: #E65924;
    border: 1px solid transparent;
    margin-top: 60px;
    text-decoration: none;
    -webkit-transition: 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
    transition: 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
    }

    .custom-section .col-lg-4 a:hover {
    color: #E65924;
    background-color: #fff;
    border: 1px solid #E65924;
    }

    .custom-section .col-lg-8 img {
    width: 100%;
    position: absolute;
    top: -15rem;
    right: -11%;
    }

    @media screen and (max-width: 991.98px) {
    .custom-section .col-lg-8 img {
        width: 100%;
        position: relative;
        top: 0;
        right: 0;
    }
    }

    .custom-section .col-lg-8 .animate-img img {
    width: 118px;
    position: absolute;
    top: -13.5rem;
    right: 2.9rem;
    }
    /*# sourceMappingURL=style.css.map */
    </style>

    <title>Quaility</title>
</head>

<body>
    <div class="container">
        <header class="head my-3">
            <nav class="navbar navbar-expand-lg navbar-light head__custom-nav">
                <a class="navbar-brand d-flex align-items-center" href="#">
                    {{-- <img src="{{ asset('assets/img/logo.png') }}" alt="website logo"> --}}
                    <span>QUAILITY</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span><img src="{{ asset('assets/img/menu.png') }}" alt=""></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>
    <div class="container">
        <div class="row custom-section d-flex align-items-center">
            <div class="col-12 col-lg-4">
                <h2>QUAILITY</h2>
                {{-- <h3>Process</h3> --}}
                <p>PT. BUMI UNGGAS FARM - SITUBONDO</p>
                <a href="{{ route('login') }}">Pelajari Selengkapnya</a>
            </div>
            <div class="col-12 col-lg-8">
                <img src="{{ asset('assets/img/bg.png') }}" alt="Team process banner">
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
