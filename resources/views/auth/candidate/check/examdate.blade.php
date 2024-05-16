<!DOCTYPE html>
<html>

<head>
    <title>Check Examination Date</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <style>
        .card {
            margin-top: 50px;
            opacity: 0.9;
        }

        .colored-toast {
            color: white;
            background-color: #f44336;
        }
    </style>

</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-white bg-white">
        <div class="container">
            <a class="navbar-brand btn btn-outline-success" href="{{ url('/') }}">Home</a>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5" style="background-color: #ffffff; border-radius:2em">
                    <div class="card-header" style="background-color: #ffffff; border-radius:2em">
                        <h5 class="card-title">Check Examination Date <i class="fa fa-user"></i></h5>
                        <p><a href="#">Using scratch card & Online Authentication code</a></p>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{ route('auth.exam.date') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input placeholder="Your Admission number" type="text" name="admissionnumber"
                                    class="form-control" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-info">Authenticate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                customClass: {
                    toast: 'colored-toast'
                }
            });

            Toast.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            });
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
