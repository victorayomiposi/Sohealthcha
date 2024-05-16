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
            box-sizing: border-box;
        }

        .card {
            width: 200mm;
            margin: 1mm auto;
            padding: 12px;
            position: relative;
        }

        .card img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 5px;
            position: absolute;
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
        }

        .text-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Adjusted width to cover entire card */
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* .pin {
            position: absolute;
              bottom: 1px;
            left: 0px;
            font-weight: bold;
        } */
        .expiredate {
            position: absolute;
            bottom: 105%;
            left: 0px;
            font-weight: bold;
        }
        .accesscode {
            position: absolute;
            bottom: 98%;
            left: 0px;
            font-weight: bold;
        }
        .serial {
            position: absolute;
            bottom: 105%;
            right: 40%;
            font-weight: bold;
        }

        .pin {
            position: absolute;
            bottom: 98%;
            right: 40%;
            font-weight: bold;
        }

        .link {
            position: absolute;
            bottom: 85%;
            right: 60%;
            font-weight: bold;
            font-size: 14px;
            color: royalblue
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="{{ public_path('newhealthcard.jpeg') }}" alt="ATM Card Template">
        <div class="text-container">
            <p class="pin">PN: {{ $pins->pinnumber }}</p>
            <p class="serial">SN: {{ $pins->serialnumber }}</p>
            <p class="expiredate">Expiry Date: {{ \Carbon\Carbon::parse($expire_at)->format('d F Y') }}</p>
            <p class="accesscode">Access Code: {{ $pins->code }}</p>
            <p class="link">http://sohealthcha.org/online/pin/login</p>
        </div>
    </div>
</body>

</html>
