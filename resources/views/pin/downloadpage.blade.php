<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Page</title>
    @include('title')
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f0f2;
            background-size: cover;
            background-opacity: 0.8;
        }

        .card {
            background-color: #fdfdff;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        .countdown-text {
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Download Your PIN</h5>
                        <p class="card-text"> Please check your download history for the PIN and Serial
                            If you need to,
                            you can <a href="" class="btn btn-primary">Download</a>
                            {{-- <a href="{{ route('customer.download.pin', ['customerId' => $customerid]) }}"
                                    class="btn btn-primary">Download</a> --}}
                        </p>
                        <p class="countdown-text">Downloading will start automatically in <span id="countdown">5</span>
                            seconds...</p>
                        <p class="countdown-text"><a href="{{ route('home') }}">Return Home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+UAq9sId3Va6jh5p6qrekVQ4NXOt6AuLU5PAFjAp0iCWfGJXwNJWlsR5D6" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Countdown timer
            var countdown = 5; // 5 seconds
            var countdownInterval = setInterval(function() {
                if (countdown > 0) {
                    $('#countdown').text(countdown);
                    countdown--;
                } else {
                    clearInterval(countdownInterval);
                    // Redirect to the download URL after countdown
                    window.location.href =
                        "{{ route('customer.download.pin', ['customerId' => $customerid]) }}";
                }
            }, 1000);
        });
    </script>


</body>

</html>
