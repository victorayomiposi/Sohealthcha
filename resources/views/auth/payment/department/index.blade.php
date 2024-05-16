<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Department Payment Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar-brand img {
            width: 3em;
            height: 3em;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 350px;
            margin: 10px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
            transition: background-color 0.5s;
        }

        .card:hover {
            background: linear-gradient(to top, #d4dce9 0%, #ffffff 100%);
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .list-group-item {
            font-size: 12px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-footer a {
            text-decoration: none;
            color: inherit;
        }

        @media (min-width: 768px) {
            .card {
                max-width: calc(33.33% - 20px);
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('favicon.jpg') }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card-container">
            <div class="card border-primary">
                <div class="card-header"><i class="fas fa-book"></i>Payment for Indigene</div>
                <p class="card-text">Pay for various departments fees.</p>
                <div class="card-body" style="height: 200px; overflow-y: auto;">
                    <ul class="list-group list-group">
                        @foreach ($departmentpaymentsindigenes as $departmentpaymentsindigene)
                            @php
                                $department = DB::table('course_selection')
                                    ->where('id', $departmentpaymentsindigene->id)
                                    ->pluck('schoolname')
                                    ->first();
                            @endphp
                            <li class="list-group-item"><i style="font-weight: 900" class="fa fa-check"></i>
                                {{ $department }}
                                (₦{{ number_format($departmentpaymentsindigene->price, 2, '.', ',') }})
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer mt-2 text-center"><a
                        href="{{ route('payment.department.create.indigene', ['id' => 2]) }}"><i
                            class="fas fa-arrow-right"></i> Click here to proceed</a></div>
            </div>


            <div class="card border-primary">
                <div class="card-header"><i class="fas fa-book"></i>Payment for Non-indigene</div>
                <p class="card-text">Pay for various departments fees.</p>
                <div class="card-body" style="height: 200px; overflow-y: auto;">
                    <ul class="list-group list-group">
                        @foreach ($departmentpaymentsnonindigenes as $departmentpaymentsnonindigene)
                            @php
                                $department = DB::table('course_selection')
                                    ->where('id', $departmentpaymentsnonindigene->id)
                                    ->pluck('schoolname')
                                    ->first();
                            @endphp
                            <li class="list-group-item"><i style="font-weight: 900" class="fa fa-check"></i>
                                {{ $department }}
                                (₦{{ number_format($departmentpaymentsnonindigene->price, 2, '.', ',') }})
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer mt-2 text-center"><a
                        href="{{ route('payment.department.create.nonindigene', ['id' => 2]) }}"><i
                            class="fas fa-arrow-right"></i> Click here to proceed</a></div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
