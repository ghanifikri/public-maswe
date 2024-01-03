<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/remixicon//remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/library/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/style/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @yield('style')
    <title>Maswe Farm House</title>
</head>

<body>
    @include('frontend.layouts.navbar')
    <!-- ======= Hero Section ======= -->
    @yield('hero')
    <!-- ======= End Hero Section ======= -->
    <main class="main">
        @yield('content')
    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-down">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('frontend/img/logo_footer.svg') }}" alt="">
                    </div>
                    <div class="col-lg-4">
                        <div class="button-top">
                            <a href="#" class="button-order">ORDER NOW</a>
                            <a href="#" class="button-contact">CONTACT US</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-center">
                            <div class="social-links">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-divider">
            <div class="container">
                <div class="solid"></div>
            </div>
        </div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12 footer-contact">
                        <h4>MASWE FARMHOUSE</h4>
                        <p>
                            Jl. Kali Gandu, Purwakarta <br>
                            Kec. Purwakarta, Kota Cilegon<br>
                            Banten <br>
                            <strong>Phone:</strong> +62 8559 55488 55<br>
                            <strong>Email:</strong> maswefarmhouse13@gmail.com<br>
                        </p>
                        <div class="social-links text-center mt-3">
                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 col-md-6 col-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div> --}}
                    {{-- <div class="col-lg-4 col-md-6 col-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Maswe Farmhouse</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->
    <script src="{{ asset('frontend/library/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/library/jquery/jquery-min.3.6.0.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        @if (session()->has('success'))
            Swal.fire({
                icon: 'success',
                title: 'BERHASIL!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            })
        @elseif (session()->has('error'))
            Swal.fire({
                icon: 'error',
                text: 'GAGAL!',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 10000
            })
        @endif
    </script>
    @yield('js')
</body>

</html>
