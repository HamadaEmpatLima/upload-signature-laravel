<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <title>Email Verification</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Verify Your Email Address</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            Thank you for signing up! Please verify your email address by
                            clicking the link below or copying it to your browser.
                        </p>
                        <a href="{{ $url }}" class="btn btn-primary mt-3 mb-3 mx-auto">Verify Email</a>
                        <div class="input-group mt-3 mb-3">
                            <input type="text" value="{{ $url }}" class="form-control"
                                id="verification-link" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
