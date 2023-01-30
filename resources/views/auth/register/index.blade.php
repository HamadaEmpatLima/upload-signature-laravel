<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register | KodegiriHamada</title>

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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo"">
            <a href="#"><b>Kodegiri</b>Hamada</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register</p>
                <form action="{{ route('api.auth.register') }}" method="POST" onsubmit="register()" id="form-register">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name" id="name"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="name-invalid-feedback"></span>
                    </div>
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password confirmation"
                            name="password_confirmation" id="password_confirmation" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="password_confirmation-invalid-feedback"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="string" class="form-control" placeholder="Phone number" name="phone"
                            id="phone" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback" id="phone-invalid-feedback"></span>
                    </div>
                    <div class="row item-right">
                        <div class="col-4 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">Login</a>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.5/axios.min.js"></script>

    @include('layouts.script')

    <script>
        async function register() {
            if (event) {
                event.preventDefault();
            }
            resetErrors();

            const form = event.target;
            $(form).find('[type="submit"]').attr('disabled', true);
            $(form).find('[type="submit"]').html('Loading...');
            let formData = $('#form-register').serialize();
            try {
                const result = await axios.post($(form).attr('action'), formData);

                if (result) {
                    if (result.data.status && result.data.status === 'success') {
                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Success',
                            body: result.data.message
                        })
                    }
                }
            } catch (error) {
                if (error.response.status === 422) {
                    setErrors(error, form);
                }
            }

            $(form).find('[type="submit"]').attr('disabled', false);
            $(form).find('[type="submit"]').html('Register');
        }
    </script>
</body>

</html>
