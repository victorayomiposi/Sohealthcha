<!DOCTYPE html>
<html>

<head>
    <title>EXAM DATE {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
        {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }} 
        {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}
        {{ !empty($allocatebatch) ? $allocatebatch : 'null' }} 
        {{ !empty($allocation) ? $allocation : 'null' }}</title>

    <style>
        body {
            font-size: 12px;
        }

        .card {
            width: 90%;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            background-color: rgb(142, 142, 142);
            border-radius: 10px;
        }

        .passport {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;

        }

        .passport img {
            width: 13em;
            height: 12em;
            float: right;
            border-radius: 5px;
        }

        .photo {
            width: 30%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            position: absolute;
            top: 5em;
            left: 13em;
            z-index: -1;
        }

        .info {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .value {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="card">
       <i style="float: right"> {{ $currentDateTime }}</i><br>
        <img style="opacity:.1;" class="photo"
            src="{{ asset('assets/images/favicon.png') }}"
            alt="Background Image">

        <div class="header">
            <h2>Examination slip for session {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}</h2>
        </div>
        <div class="passport">
            <img src="{{ asset('storage/'.$candidateInfo->passport) }}"
                alt="Passport Photo">
        </div>
        <div class="info">
            <span class="label">Name:</span>
            <span class="value">{{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
                {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}
                {{ !empty($candidateInfo->othername) ? $candidateInfo->othername : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Session:</span>
            <span class="value">{{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Batch:</span>
            <span class="value">{{ !empty($allocatebatch) ? $allocatebatch : 'Check Back Soon' }}</span>
        </div>
       
        <div class="info">
            <span class="label">Time:</span>
            <span class="value">{{ !empty($allocation) ? $allocation : 'Check Back Soon' }}</span>
        </div>
        
        <div class="info">
            <span class="label">Date:</span>
            <span class="value">{{ !empty($examDate) ? $examDate : 'Check Back Soon' }}</span>
        </div>

        <div class="info">
            <span class="label">Examination Login Information:</span>
        </div>
        <div class="info">
            <span class="label">Username:</span>
            <span
                class="value">{{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Password:</span>
            <span
                class="value">{{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Examination score:</span>
            <span class="value">________</span>
        </div>
        <div style="float: right;" class="info">
            <span class="label">Signature:</span>
            <span class="value">__________________</span>
        </div>
        <div class="info">
            <span class="label">&emsp;</span>
            <span class="value">&emsp;</span>
        </div>
    </div>
    <hr>
    <div class="card">
        <i style="float: right"> {{ $currentDateTime }}</i><br>

        <img style="opacity:.1;" class="photo"
            src="{{ asset('assets/images/favicon.png') }}"
            alt="Background Image">

        <div class="header">
            <h2>Examination slip for session {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}</h2>
        </div>
        <div class="passport">
            <img src="{{ asset('storage/'.$candidateInfo->passport) }}"
                alt="Passport Photo">
        </div>
        <div class="info">
            <span class="label">Name:</span>
            <span class="value">{{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
                {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}
                {{ !empty($candidateInfo->othername) ? $candidateInfo->othername : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Session:</span>
            <span class="value">{{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Batch:</span>
            <span class="value">{{ !empty($allocatebatch) ? $allocatebatch : 'Check Back Soon' }}</span>
        </div>
       
        <div class="info">
            <span class="label">Time:</span>
            <span class="value">{{ !empty($allocation) ? $allocation : 'Check Back Soon' }}</span>
        </div>
    
        <div class="info">
            <span class="label">Date:</span>
            <span class="value">{{ !empty($examDate) ? $examDate : 'Check Back Soon' }}</span>
        </div>

        <div class="info">
            <span class="label">Examination Login Information:</span>
        </div>
        <div class="info">
            <span class="label">Username:</span>
            <span
                class="value">{{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Password:</span>
            <span
                class="value">{{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'null' }}</span>
        </div>
        <div class="info">
            <span class="label">Examination score:</span>
            <span class="value">________</span>
        </div>
        <div style="float: right;" class="info">
            <span class="label">Signature:</span>
            <span class="value">__________________</span>
        </div>
        <div class="info">
            <span class="label">&emsp;</span>
            <span class="value">&emsp;</span>
        </div>
    </div>
</body>

</html>
