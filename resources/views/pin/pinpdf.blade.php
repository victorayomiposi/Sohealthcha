<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pin And Serial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .card {
            width: 200mm; /* Adjusted to be closer to A6 size */
            margin: 5mm auto; /* Adjusted margin for centering */
            padding: 10mm;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .card p {
            font-size: 14px; /* Adjusted font size */
            font-weight: bold;
            margin: 8px 0; /* Adjusted margin */
        }

        .title {
            font-size: 16px; /* Adjusted title font size */
            font-weight: bold;
            color: blue;
            text-align: center;
            margin-bottom: 10px; /* Added margin bottom for spacing */
        }
    </style>
</head>

<body>
    <div class="card">
        <p class="title">Candidate Registration Pin</p>
        <p>Pin Number: {{ $pins->pinnumber }}</p>
        <p>Serial Number: {{ $pins->serialnumber }}</p>
        <p>Expiry Date: {{ \Carbon\Carbon::parse($expire_at)->format('d F Y') }}</p>
    </div>
</body>

</html>
