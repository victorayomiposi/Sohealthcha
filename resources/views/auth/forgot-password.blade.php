
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
      <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(assets/images/background/bg2.jpg); 
            background-size: cover;
            background-opacity: 0.8;
        }
        .password-reset-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container password-reset-container">
        <div class="text-center">
            <h2>Forgot Your Password?</h2>
            <p>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

       

        <form method="POST" action="{{ route('password.email') }}" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>

        <div class="text-end mt-3">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
    
    
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-dark">
                @if ($errors->any())
             
                    @foreach ($errors->all() as $error)
                       {{ $error }} 
                    @endforeach
                
        @endif
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS (add at the end of the body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script to trigger the toast when errors occur -->
    <script>
        @if ($errors->any())
        var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
        errorToast.show();
        @endif
    </script>
</body>
</html>

