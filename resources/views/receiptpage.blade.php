<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Fees Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border-color: #ccc;
            border-style: solid;
            border-width: 1px;
            border-radius: 10px;
            background-color: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .logo-container {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .school-info {
            text-align: center;
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
            color: rgb(255, 0, 0);
            font-weight: 600
        }

        .receipt-info table {
            width: 100%;
        }

        .receipt-info td {
            padding: 5px;
        }

        .receipt-info .receipt-details {
            border-collapse: collapse;
        }

        .receipt-info .receipt-details td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }

        td {
            font-weight: 700;
        }
    </style>
</head>

<body>
    @php
        $amountpaid = $customer->amount - 900;
        $department = DB::table('course_selection')
            ->where('id', $customer->department)
            ->pluck('schoolname')
            ->first();
    @endphp
    <div class="container">
        
        <div class="receipt-info">
            <table>
                <tr>
                    <td style="text-align: left">
                        <div class="logo-container">
                            <img src="{{ public_path('logo/ondo.png') }}" alt="School Logo" class="logo">
                        </div>
                    </td>
                    <td style="text-align: center">
                        <div class="logo-container">
                            <img src="{{ public_path('logo/nigeria.jpg') }}" alt="School Logo" class="logo">
                        </div>
                    </td>
                    <td style="text-align: right">
                        <div class="logo-container">
                            <img src="{{ public_path('logo/sohealthcha.jpg') }}" alt="School Logo" class="logo">
                        </div>
                    </td>

                </tr>
            </table>
        </div>
        <div class="school-info">
            <h4 style="color: #337ab7; font-weight: 900;">ONDO STATE OF NIGERIA</h4>
            <h1 style="color: #337ab7; font-size: 27px; font-weight: 1000;">COLLEGE OF HEALTH TECHNOLOGY, AKURE</h1>

        </div>
        <div class="subtitle">
            <h3>Receipt</h3>
        </div>
        <div class="receipt-info">
            <table>
                <tr>
                    <td style="width: 7em" colspan="2">Receipt No.: <span
                            style="text-align: left">{{ $customer->code }}</span>
                    </td>
                    <td style="width: 7em;text-align:right" colspan="2">Date.: <span
                            style="text-align: right">{{ \Carbon\Carbon::parse($customer->time)->format('d-m-y') }}</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="subtitle">
            <h3>Student Information</h3>
        </div>
        <div class="receipt-info">
            <br>
            <table>
                <tr>
                    <td style="width: 7em" colspan="2">Student Name: <span
                            style="text-align: left">{{ strtoupper($candidateInfo->surname) }}
                            {{ strtoupper($candidateInfo->firstname) }}
                            {{ strtoupper($candidateInfo->othername) }}</span>
                    </td>
                    <td style="width: 7em;text-align:right" colspan="2">Admission No: <span
                            style="text-align: right">{{ $candidateInfo->admissionnumber }}</span>
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td style="width: 7em" colspan="2">Department: <span
                            style="text-align: left">{{ $candidateInfo->candidateInstitution->firstchoiceschool }}</span>
                    </td>
                    <td style="width: 7em;text-align:right" colspan="2">Academy session: <span
                            style="text-align: right">{{ $candidateInfo->session }}</span>
                    </td>
                </tr>

            </table>

        </div>
        <div class="subtitle">
            <h3>Fee Description</h3>
        </div>
        <div class="receipt-info">
            <table class="receipt-details">
                <tr>
                    <td>{{ $customer->purpose }}:</td>
                    <td>N{{ number_format($amountpaid, 2, '.', ',') }}</td>
                </tr>

            </table>
        </div>
        <div class="subtitle">
            <h3>Payment Details</h3>
        </div>
        <div class="receipt-info">
            <table>
                <tr>
                    <td>Payment Method:</td>
                    <td>Digital Transaction</td>
                </tr>
                <tr>
                    <td>Amount Paid:</td>

                    <td>N{{ number_format($amountpaid, 2, '.', ',') }}</td>
                </tr>
                <tr>
                    <td>Payer Name:</td>
                    <td>{{ $customer->fullname }}</td>
                </tr>
                <tr>
                    <td>Payment Period</td>
                    <td>{{ $customer->session }}</td>
                </tr>
                <tr>
                    <td>Target Department</td>
                    <td>{{ $department }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>ONDO STATE COLLEGE OF HEALTH TECHNOLOGY AKURE</p>
        </div>
    </div>
</body>

</html>
