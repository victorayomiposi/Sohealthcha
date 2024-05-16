<!DOCTYPE html>
<html>

<head>
   <title>  ACCEPTANCE LETTER {{ !empty($candidateInfo->surname) ? $candidateInfo->surname :
     'null' }} {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname
     : 'null' }}</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        .letter {
            width: 95%;
            padding: 20px;
            border: 1px solid black;
            border-radius: 10px;
            background-color: white;
            line-height: 1.5;

        }

        .address {
            text-align: left;
            margin-bottom: 20px;
        }

        .matric-date {

            margin-bottom: 20px;
        }

        .matric {
            float: left;
        }

        .date {
            float: right;
        }

        .topic {
            text-decoration: underline;
            margin: 20px 0;
            font-weight: bold;
            text-align: center;
        }

        .body {
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 20px;
        }

        .student {
            float: right;
        }

        .parent-signature {
            text-align: left;
        }

        .photo {
            width: 80%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            position: absolute;
            top: 12em;
            left: 5em;
            z-index: -1;
        }

        .logo {
            width: 100%;
            height: auto;
        }
        
    </style>
</head>

<body>
    <div class="letter">
        <img style="opacity:.1;" class="photo" src="{{ asset('assets/images/favicon.png') }}" alt="Background Image">

        <div class="header">
           <div class="matric-date">
            <div class="matric"> 
               The Provost,<br />
            College of Health Technology,<br />
            Oda Road,<br />
            Akure.
            </div>
            <div class="date">Date : 28th Aug 2023<br>Admission No: {{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'No admissionnumber found' }}<br>
Ref No :<i>{{ $time }}-</i><i style="font-weight:700;">{{ !empty($candidateInfo->candidateresult->score) ? $candidateInfo->candidateresult->score : '0' }}</i>
            </div>
        </div>
        </div>
        <br>
        <br>
        <br>
        <div class="topic">
            LETTER OF ACCEPTANCE OF ADMISSION INTO {{ $candidateInfo->session ?? 'null' }}/{{ ($candidateInfo->session ?? 'null') + 1 }} ACADEMIC SESSION
        </div>

        <div class="body">
            <p>
                I,&nbsp;
               @php
       $gender = !empty($candidateInfo->gender) ? strtoupper($candidateInfo->gender) : 'null';
       $maritalStatus = !empty($candidateInfo->maritalstatus) ? strtoupper($candidateInfo->maritalstatus) : 'null';
       $title = '';
       
       if ($gender === 'MALE' || $gender === 'Male') {
           $title = 'Mr';
           if ($maritalStatus === 'MARRIED' || $maritalStatus === 'Married') {
               $title = 'Mr';
           }
       } elseif ($gender === 'FEMALE' || $gender === 'Female') {
           if ($maritalStatus === 'MARRIED' || $maritalStatus === 'Married') {
               $title = 'Mrs';
           } elseif ($maritalStatus === 'SINGLE' || $maritalStatus === 'Single') {
               $title = 'Miss';
           } elseif ($maritalStatus === 'DIVORCE' || $maritalStatus === 'Divorce') {
               $title = 'Miss';
           }
       }
       
       echo $title;
   @endphp
   <u> &nbsp;

                {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
                    {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}
                    {{ !empty($candidateInfo->othername) ? $candidateInfo->othername : 'null' }}</u> of
                {{ !empty($candidateInfo->address) ? $candidateInfo->address : 'null' }}&nbsp;with contact No
                &nbsp;{{ !empty($candidateInfo->phone) ? $candidateInfo->phone : 'null' }}&nbsp; do
                hereby wish to abide by the following Terms and Conditions only as the
                means of being admitted into the Ondo State College of Health
                Technology, Akure having being prima-facie qualified and admitted to
                study,
                &nbsp;{{ !empty($candidateInfo->candidateInstitution->firstchoicecourse) ? $candidateInfo->candidateInstitution->firstchoicecourse : 'no Course found' }}&nbsp;
                in the&nbsp;{{ !empty($candidateInfo->candidateInstitution->firstchoiceschool) ? $candidateInfo->candidateInstitution->firstchoiceschool : 'no department found' }}&nbsp;
            </p>

            <p>2. I equally wish to state that I will abide by the Rules and Regulations of the College without
                exception and that:</p>
            <p>a. this admission is provisional and subject to passing the probation examination before being a full
                student.</p>
            <p>b. all rules pertaining to occupants of hostels would be adhered to strictly by me.</p>
            <p>c. payment of prescribed fees paid to the School Account (2028143453 First Bank) are non- refundable.
            </p>
            <p>d. the Dress code vis-à-vis the professional ethics of each Department would be strictly adhered to</p>
            <p>e. I would not let myself be directly or indirectly involve in cultism and other vice as long as I
                remain the student of the college.</p>

            <p>3. The following documents are attached:</p>
            <p>i. A letter of undertaking from my Parent/Sponsor and a letter of guarantor by a Christian Clergy or
                Muslim Cleric, with their telephone number(s) guaranteeing my good behavior in compliance with the
                institution’s Rules and Regulations.</p>
            <p>ii. A sworn affidavit by the student giving information about his/her name, address, e-mail address,
                phone number and e-mail address of parents in question, in a High Court of Justice required at the
                point of Registration, that I have voluntarily entered into these conditions without any pressure
                whatsoever.</p>
        </div>

        <div class="footer">
            <div class="student">
                -----------------------------------------<br />STUDENT’S SIGNATURE
            </div>
            <div class="parent-signature">
                ---------------------------------<br />PARENT/GUARDIAN SIGNATURE
            </div>
            <i style="text-align:right">printed date : {{ $currentTime }}</i> 
        </div>
    </div>
</body>

</html>
