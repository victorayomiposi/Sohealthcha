<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size:12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .card-bg {
            background-image: url('newhealthcard.jpeg'); 
            background-size: cover;
            background-position: center;
            height: 150px;  
            padding: 15px;
            color: white; 
            position: relative;
        }

        .pin {
            position: absolute;
            bottom: 1px;
            left: 2px;
        }

        .serial {
            position: absolute;
            bottom: 1px;
            right: 2px;
        }

        .content {
            padding: 15px;
        }

        .content p {
            margin: 0 0 5px;
            color:blue;
            font-weight:700;
        }
    </style>
</head>

<body>

    <table>
        @foreach ($existingPin->chunk(2) as $chunk)
            <tr>
                @foreach ($chunk as $pin)
                    <td style="padding-top:0.50em;">
                        <div class="card">
                            <div class="card-bg">
                               <div class="content">
                                    <p class="pin"><b>PIN</b> : {{ $pin->pinnumber }}</p>
                                <p class="serial"><b>SN</b> : {{ $pin->serialnumber }}</p>
                            </div>
                         </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>

</body>

</html>
