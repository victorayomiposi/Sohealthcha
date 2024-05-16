<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        /* body {
            background-image: url({{ asset('images/ondo-bg.jpeg') }});
            background-size: cover;
            background-opacity: 0.8;
        } */

        .card {
            box-shadow: 0 0 10px rgba(10, 153, 255, 0.719);
        }
    </style>
</head>

<body>
    <div class="card text-center">
        <div class="card-body">
            <p>If the page does not open in a new tab, <a href="{{ $authorizationUrl }}" target="_blank">click here</a>.
            </p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        setTimeout(() => {
            window.open("{{ $authorizationUrl }}", "_blank");
        }, 2000);
        setTimeout(() => {
            window.history.back();
        }, 3000);
    </script>
</body>

</html>
