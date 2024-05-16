 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @include('title')
     <link rel="icon" href="assets/images/favicon.png" type="image/png">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
         body {
             background-image: url('bgimage3.jpeg');
             background-size: cover;
             background-opacity: 0.8;
         }

         .login-container {
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
     <div class="container login-container">
         <div class="text-center">
             <img style="width:4em; height:4em;" src="assets/images/favicon.png" alt="Logo">
         </div>

         <form action="{{ route('login') }}" method="POST" class="mt-4">
             @csrf
             <div class="mb-3">
                 <label for="username" class="form-label">Username</label>
                 <input type="text" class="form-control" id="username" name="username" required>
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control" id="password" name="password" required>
             </div>
             <div class="d-flex justify-content-between">
                 <a class="btn btn-warning" href="{{ url('/') }}">Home</a>
                 <button type="submit" class="btn btn-primary">Login</button>
             </div>
         </form>

         <div class="text-center mt-3">
             <a href="{{ route('password.request') }}">Forgot Password?</a>
         </div>
     </div>

     <!-- Toast for displaying errors -->
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
