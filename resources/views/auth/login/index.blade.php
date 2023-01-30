<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | KodegiriHamada</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Kodegiri</b>Hamada</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('api.auth.signin') }}" method="POST" onsubmit="signin()" id="form-signin">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="email-invalid-feedback"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="password-invalid-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> --}}
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Login</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.5/axios.min.js"></script>

    @include('layouts.script')

    <script>
        async function signin() {
            event.preventDefault();
            resetErrors();

            const form = event.target;
            $(form).find('[type="submit"]').attr('disabled', true);
            $(form).find('[type="submit"]').html('Loading...');
            const formData = $('#form-signin').serialize();

            try {
                const result = await axios.post($(form).attr('action'), formData);

                if (result) {
                    if (result.data.status && result.data.status === 'success') {
                        document.location = "{{ url('/document') }}";
                    }
                }
            } catch (error) {
                if (error.response.status === 422) {
                    setErrors(error, form);
                }
            }

            $(form).find('[type="submit"]').attr('disabled', false);
            $(form).find('[type="submit"]').html('Login');
        }
    </script>
</body>

</html>
