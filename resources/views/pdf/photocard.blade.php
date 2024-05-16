<!DOCTYPE html>
<html>

<head>
    <title>PHOTOCARD {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
        {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}</title>
    <style>
        body {
            border: 1px solid black;
            border-radius: 10px;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
            border: 1px solid black;
            border-radius: 10px;
        }

        .logo {
            width: 7em;
            height: 5em;
            margin-left: 3px;
        }

        .school-info {
            text-align: center;
            flex-grow: 1;
        }

        .student-passport {
            width: 7em;
            height: 5em;
            margin-right: 3px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .details-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .student-details {
            flex-basis: 50%;
        }

        .class-details {
            flex-basis: 50%;
            text-align: right;
        }


        .photo {
            width: 50%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            position: absolute;
            top: 16em;
            left: 10em;
            z-index: -1;
        }
    </style>
</head>


<body>
    <div class="header">
        <table>
            <tr>
                <th style="border: none;"><img class="logo" src="{{ public_path('assets/images/ondo.png') }}"
                        alt="School Logo"></th>
                <th style="border: none;">
                    <h4 style="font-size: 20px; color: rgb(255, 103, 8); font-weight: 1000;">COLLEGE OF HEALTH TECHNOLOGY
                    </h4><br>
                  {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }} Academic Session
                </th>
                <th style="border: none;"><img class="student-passport"
                        src="{{ public_path('assets/images/favicon.png') }}" alt="Student Passport"></th>
            </tr>
        </table>
    </div>
    <table class="result">
        <img style="opacity:.1;" class="photo"
            src="{{ public_path('assets/images/favicon.png') }}"
            alt="Background Image">
        <tr>
            <td>
                <h4 style="text-align:center;">CANDIDATE PERSONAL INFORMATION</h4>
            </td>
            <td colspan="2" style="text-align: right;"><img class="student-passport"
                    src="{{ public_path('storage/'.$candidateInfo->passport) }}" alt="Student Passport"></td>
        </tr>
        <tr>
            <td>Admission Number</td>
            <td style="border-right: none">
                {{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : 'No admissionnumber found' }}
            </td>
            <td style="border-left: none"></td>
        </tr>

       

        <tr>
            <td>Name of Candidate</td>
            <td style="border-right: none">
                {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
                {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}
                {{ !empty($candidateInfo->othername) ? $candidateInfo->othername : 'null' }}
            </td>
            <td style="border-left: none"></td>
        </tr>
        <tr>
            <td>Date of Birth</td>
            <td colspan="2">
                {{ !empty($candidateInfo->dateofbirth) ? $candidateInfo->dateofbirth : 'null' }}
            </td>
        </tr>
        <tr>
            <td>Gender</td>
            <td colspan="2">
                {{ !empty($candidateInfo->gender) ? $candidateInfo->gender : 'null' }}
            </td>
        </tr>
        <tr>
            <td>Contact Addess: </td>
            <td colspan="2">{{ !empty($candidateInfo->address) ? $candidateInfo->address : 'address not found' }}
            </td>
        </tr>
        <tr>
            <td>Contact GSM Number:</td>
            <td colspan="2">{{ !empty($candidateInfo->phone) ? $candidateInfo->phone : 'Phone number not found' }}
            </td>
        </tr>
        <tr>
            <td>State of Origin</td>
            <td colspan="2">
                {{ !empty($candidateInfo->stateoforigin) ? $candidateInfo->stateoforigin : 'state of origin not found' }}
            </td>
        </tr>
        <tr>
            <td>Local Government of Origin</td>
            <td colspan="2">
                {{ !empty($candidateInfo->localgovtorigin) ? $candidateInfo->localgovtorigin : 'LGA not found' }}
            </td>
        </tr>
        <tr>
            <th style="padding-top: 1em;" colspan="3">Result Card Detail</th>

        </tr>
        @foreach ($admissionPin as $admissionPin)
            <tr>
                <td>Result Serial Number</td>
                <td colspan="2">
                    {{ !empty($admissionPin->serial) ? $admissionPin->serial : 'No found, kindly report issue to Admin' }}
                </td>
            </tr>

            <tr>
                <td>Result PIN Number</td>
                <td colspan="2">
                    {{ !empty($admissionPin->pin) ? $admissionPin->pin : 'Not found, kindly report issue to Admin' }}
                </td>
            </tr>
        @endforeach
        <tr>
            <th style="padding-top: 1em;" colspan="3">CANDIDATE CHOICE OF DEPARTMENT & COURSE</th>

        </tr>
        <tr>
            <td>Department</td>
            <td colspan="2">
                {{ !empty($candidateInfo->candidateInstitution->firstchoiceschool) ? $candidateInfo->candidateInstitution->firstchoiceschool : 'no department found' }}
            </td>
        </tr>
        <tr>
            <td>Course</td>
            <td colspan="2">
                {{ !empty($candidateInfo->candidateInstitution->firstchoicecourse) ? $candidateInfo->candidateInstitution->firstchoicecourse : 'no course found' }}
            </td>
        </tr>
        <tr>
            <th style="padding-top:2%; text-align:center; color:red" colspan="3"><small>You are requested to print
                    and bring this slip to the Examination Hall</small></th>
        </tr>
    </table>
    <i style="float: left;">
        {{ $candidateInfo->Pinstore->status == 1 ? 'Online Registration' : 'Manual Registration' }}
    </i>
    
    <i style="float: right;">{{ $currentDateTime }}</i>
</body>

</html>
