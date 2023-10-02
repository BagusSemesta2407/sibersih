
<!doctype html>
<html lang="en">

<head>
    <title>Login - SIBERSIH</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/login-asset/css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <a href="/">
                Landing Page
            </a>
            {{-- <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login #05</h2>
                    
                    <img src="/logo-subang.png" alt="" srcset=""> | <img src="/logo.png" alt="" srcset="" width="100" height="100">

                </div>
            </div> --}}
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url(/assets-lp/assets/images/home.jpg);"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100 mb-3">
                                    <h3>SIBERSIH</h3>
                                    <small>Sistem Informasi Kebersihan Kecamatan Subang</small>
                                </div>
                                {{-- <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p>
                                </div> --}}
                            </div>
                            <form action="{{ route('login') }}" class="signin-form" method="POST">
                                @csrf
                                <div class="form-group mt-3">
                                    <input id="username" type="text"
                                        class="form-control @error('username')
                                        is-invalid
                                    @enderror"
                                        name="username" value="{{ old('username') }}" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <input id="password-field" type="password"
                                        class="form-control @error('password')
                                        is-invalid
                                    @enderror"
                                        name="password" autocomplete="password" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    {{-- <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span> --}}
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">
                                        Login
                                    </button>
                                </div>
                                {{-- <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div> --}}
                            </form>
                            {{-- <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p> --}}
                        </div>
                        {{-- <p>sfsd</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/login-asset/js/jquery.min.js"></script>
    <script src="/login-asset/js/popper.js"></script>
    <script src="/login-asset/js/bootstrap.min.js"></script>
    <script src="/login-asset/js/main.js"></script>

</body>

</html>
