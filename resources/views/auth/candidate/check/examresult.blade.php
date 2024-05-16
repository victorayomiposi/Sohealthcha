<!DOCTYPE html>
<html>

<head>
    <title>Candidate Authentication Change Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url({{ asset('assets/images/background/bg2.jpg') }});
            background-size: cover;
        }

        .card {
            margin-top: 50px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Candidate Authentication <i class="fa fa-user"></i></h5>
                    </div>

                    @if (session('error'))
                        <div class="card-header">
                            <div class="card-title" style="color: red;">{{ session('error') }}</div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div id="error-msg" class="alert alert-danger" style="display: none;"></div>
                        <form action="{{ route('check.examresult') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                 <input placeholder="Addmission number" type="text" name="admissionnumber"
                                    class="form-control" id="addmissionnumber" required>
                            </div>
                            <div class="form-group">
                                 <input placeholder="Pin number" type="text" name="pin"
                                    class="form-control" id="addmissionnumber" required>
                            </div>
                            <div class="form-group">
                                 <input placeholder="Serial number" type="text" name="serial"
                                    class="form-control" id="addmissionnumber" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ url('/') }}" style="float: right;" type="submit" class="btn btn-warning">Home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
