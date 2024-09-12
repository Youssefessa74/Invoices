<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>Login</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend')}}/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{asset('backend')}}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->

  <!-- Layout styles -->
	<link rel="stylesheet" href="{{asset('backend')}}/assets/css/demo2/style.css">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{asset('backend')}}/assets/images/favicon.png" />
</head>
<body>


<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">
                                    <img src="{{asset('backend/assets/images/a-guide-to-proforma-invoices.jpg')}}" class="sign-favicon ht-40" alt="">
                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <!-- Logo and title -->
                                    <a href="{{ url('/') }}" class="noble-ui-logo logo-light d-block mb-2">
                                        <h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">In<span>voic</span>es</h1>
                                    </a>
                                    <h5 class="text-muted fw-normal mb-4">مرحبا بك! تسجيل الدخول إلى حسابك.</h5>

                                    <!-- Login Form -->
                                    <form method="POST" action="{{ route('login') }}" class="forms-sample">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">البريد الالكتروني</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">كلمة المرور</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('تذكرني') }}
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-main-primary me-2 mb-2 mb-md-0 text-white">
                                            {{ __('تسجيل الدخول') }}
                                        </button>
                                        <a href="{{ route('password.request') }}" class="d-block mt-3 text-muted">هل نسيت كلمة المرور؟</a>
                                        <a href="{{ route('register') }}" class="d-block mt-3 text-muted">ليس لديك حساب؟ سجل الآن</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- core:js -->
	<script src="{{asset('backend')}}/assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{asset('backend')}}/assets/vendors/feather-icons/feather.min.js"></script>
	<script src="{{asset('backend')}}/assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
	<!-- End custom js for this page -->

</body>
</html>
