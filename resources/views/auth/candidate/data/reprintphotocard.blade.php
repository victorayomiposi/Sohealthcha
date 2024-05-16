 <!DOCTYPE html>
 <html>

 <head>
     <title>Reprint Authentication Photocard</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
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
     <div class="container">
         <div class="row justify-content-center">
             <div class="col-md-8 col-lg-6">
                 <div class="card mt-5" style="background-color: #ffffff; border-radius:2em">
                     <div class="card-header" style="background-color: #ffffff; border-radius:2em">
                         <h5 class="card-title">Reprint Authentication <i class="fa fa-user"></i></h5>
                     </div>
                     <div class="card-header" style="background-color: #ffffff; border-radius:2em">
                         <ul class="nav nav-tabs card-header-tabs">
                             <li class="nav-item">
                                 <a class="nav-link active" id="admission-tab" data-toggle="tab"
                                     href="#admission">Admission Number</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link" id="pin-serial-tab" data-toggle="tab" href="#pin-serial">Pin
                                     & Serial</a>
                             </li>
                         </ul>
                     </div>

                     <div class="card-body">
                         <div class="tab-content">
                             <div class="tab-pane fade show active" id="admission">
                                 <form action="{{ route('check.photocard') }}" method="POST">
                                     @csrf
                                     <input type="hidden" name="tab" value="0">
                                     <div class="form-group">
                                         <label for="admissionnumber">Admission Number</label>
                                         <input type="text" name="admissionnumber" class="form-control"
                                             id="admissionnumber" placeholder="Enter admission number" required>
                                     </div>
                                     <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary mr-2">Print</button>
                                     </div>
                                  </form>
                             </div>

                             <div class="tab-pane fade" id="pin-serial">
                                 <form action="{{ route('check.photocard') }}" method="POST">
                                     @csrf
                                     <input type="hidden" name="tab" value="1">
                                     <div class="form-group">
                                         <label for="pinnumber">Pin Number</label>
                                         <input type="text" name="pinnumber" class="form-control" id="pinnumber"
                                             placeholder="Enter pin number" required>
                                     </div>
                                     <div class="form-group">
                                         <label for="serialnumber">Serial Number</label>
                                         <input type="text" name="serialnumber" class="form-control"
                                             id="serialnumber" placeholder="Enter serial number" required>
                                     </div>
                                     <div class="form-group text-center">
                                        <button type="submit" class="btn btn-success mr-2">Print</button>
                                     </div>
                                 </form>
                             </div>
                         </div>
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
         $(document).ready(function() {
             $('#pin-serial-tab').on('click', function() {
                 $('#admission-tab').removeClass('active');
                 $(this).addClass('active');
                 $('#admission').removeClass('show active');
                 $('#pin-serial').addClass('show active');
             });

             $('#admission-tab').on('click', function() {
                 $('#pin-serial-tab').removeClass('active');
                 $(this).addClass('active');
                 $('#pin-serial').removeClass('show active');
                 $('#admission').addClass('show active');
             });
         });
     </script>
 </body>

 </html>
