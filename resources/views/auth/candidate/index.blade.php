<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>

    <style>
        body {
            background-image: url({{ asset('assets/images/background/bg2.jpg') }});
            background-size: cover;
        }

        .card {
            margin-top: 50px;
            opacity: 0.9;
        }
        .colored-toast{
            color: white;
            background-color: #f44336;
        }
    </style>
    
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Authentication <i class="fa fa-user"></i></h5>
                        <p><a href="#">Using scratch card & Online Authentication code</a></p>
                    </div>
                    <div class="card-body">
                        <div id="error-msg" class="alert alert-danger" style="display: none;"></div>
                        <form action="{{ route('user_auth') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                {{--  <label for="pinnumber">Pin Number</label>  --}}
                                <input placeholder="Your Pin Number" name="pinnumber" type="text" type="text" name="addmissionnumber"
                                    class="form-control" id="pinnumber" required>
                            </div>
                             
                            <div class="form-group">
                                {{--  <label for="serialnumber">Serial Number</label>  --}}
                                <input placeholder="Your Serial Number" type="text"  
                                name="serialnumber"  class="form-control" id="serialnumber" required>
                            </div>

                            <div class="form-group">
                                {{--  <label for="access_coded">Authentication code</label>  --}}
                                <input placeholder="Authentication code" type="text"name="access_coded"
                                    class="form-control" id="access_coded" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ url('/') }}" style="float: right;" type="submit" class="btn btn-warning">Home</a>
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
