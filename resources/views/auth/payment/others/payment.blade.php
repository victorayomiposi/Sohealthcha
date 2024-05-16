<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Fees Services Payment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f0f0f2;
            background-size: cover;
            background-opacity: 0.8;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #fdfdff;
            box-shadow: 0 0 10px rgba(10, 166, 55, 0.74);
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-sm-12">
            <div class="card  text-center" style="border-radius: 10px">
                <div class="card-body">
                    <h5 class="card-title text-success" style="font-weight: 800">Other Fees Payment
                        {{ $category }}</h5>
                    <div class="card-body">
                        <form action="{{ route('payment.other.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Name of service/purpose:</label>
                                        <select id="paymenttype" name="department" class="form-control" required>
                                            <option value="">Select Service</option>
                                            @foreach ($payments as $paymenttype)
                                                <option value="{{ $paymenttype->id }}">{{ $paymenttype->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Email:</label>
                                        <input name="email" type="email" class="form-control"
                                            placeholder="Enter Your Active Gmail" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 ">
                                    <div class="form-group">
                                        <label class="form-label">Phone Number:</label>
                                        <input name="phone" class="form-control" value="234" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Fullname:</label>
                                        <input name="fullname" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Admission Number:</label>
                                        <input name="admissionnumber" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="form-label">Session:</label>
                                        <select name="session" class="form-control">
                                            <option value="">selecte session</option>
                                            @for ($year = 2018; $year <= 2030; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-3">
                                    <div class="form-group">
                                        <button id="paymenttypeamount" type="button"
                                            class="col-sm-12 btn btn-success text-white p-2" style="font-weight: 800">
                                            Pay ₦00.00
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12">
                        <h5><a href="{{ route('payment.index') }}" class="btn btn-danger">Return back</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script>
        $(document).ready(function() {
            toastr.options = {
                "timeOut": 10000
            };

            @if (Session::has('error'))
                toastr.warning('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif (Session::has('successlogin'))
                toastr.info('{{ Session::get('successlogin') }}');
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif

            $('#paymenttype').change(function() {
                var paymentId = $(this).val();
                if (paymentId) {
                    $.get('/get-payment-amount-for-other/' + paymentId, function(data) {
                        $('#paymenttypeamount').text('Pay ₦' + data.price).attr('type', 'submit');
                    });
                } else {
                    $('#paymenttypeamount').text('Pay ₦00.00').attr('type', 'button');
                }
            });
        });
    </script>

</body>

</html>
