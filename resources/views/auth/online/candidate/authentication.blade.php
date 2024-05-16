<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand btn btn-outline-success" href="{{ url('/') }}">Home</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card" style="background-color: #ffffff; border-radius:2em">
                    <div class="card-header text-center" style="background-color: #ffffff; border-radius:2em">
                        <h5 class="card-title">Authentication <i class="fa fa-lock"></i></h5>
                        <p><a href="#">Using Online scratch card & Access code</a></p>
                        <span class="ml-auto">
                            <a href="#" data-toggle="tooltip" title="FAQ">
                                <i class="fa fa-question-circle"></i>
                            </a>
                        </span>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Models\SiteConfig;
                            $siteconfig = SiteConfig::where('id', 4)->pluck('price')->first();
                        @endphp

                        @if ($siteconfig == 1)
                            <form action="{{ route('online.candidate.pin.authenticate') }}" method="POST"
                                class="needs-validation" novalidate>
                                @csrf
                            @else
                                <form class="needs-validation" novalidate>
                                    @csrf
                        @endif

                        <div class="form-group">
                            <label class="form-label">Pin number</label>
                            <input placeholder="Your Pin Number" name="pinnumber" type="text" class="form-control"
                                required>
                            <div class="invalid-feedback">Please enter your Pin Number.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Serial number</label>
                            <input placeholder="Your Serial Number" type="text" name="serialnumber"
                                class="form-control" required>
                            <div class="invalid-feedback">Please enter your Serial Number.</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Access code</label>
                            <input placeholder="Access code" type="text" name="access_coded" class="form-control"
                                required>
                            <div class="invalid-feedback">Please enter your Access code.</div>
                        </div>

                        <div class="form-group text-center">

                            @if ($siteconfig == 1)
                                <button type="submit" class="btn btn-primary">Authenticate</button>
                            @else
                                <button id="lockAdmissionBtn" type="button"
                                    class="btn btn-secondary">Authenticate</button>
                            @endif
                        </div>
                        </form>
                        <span class="ml-auto">
                            <a class="btn btn-info btn-round" href="#">
                                FAQ <i class="fa fa-question-circle"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        </script>
    @endif
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif (Session::has('successlogin'))
                toastr.info('{{ Session::get('successlogin') }}');
            @endif
        });
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            $('#lockAdmissionBtn').click(function() {
                toastr.error('Admission is currently closed.');
            });
        });
    </script>
</body>

</html>
