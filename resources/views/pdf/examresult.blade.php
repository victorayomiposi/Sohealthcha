<!DOCTYPE html>
<html>

<head>
    <title>EXAM RESULT {{ !empty($candidateInfo->surname) ? $candidateInfo->surname : 'null' }}
        {{ !empty($candidateInfo->firstname) ? $candidateInfo->firstname : 'null' }}</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

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
                <th style="border: none;"><img class="logo" src="{{ asset('assets/images/ondo.png') }}"
                        alt="School Logo"></th>
                <th style="border: none;">
                    <h4 style="font-size: 20px; color: rgb(255, 103, 8); font-weight: 1000;">COLLEGE OF HEALTH TECHNOLOGY
                    </h4>
                </th>
                <th style="border: none;"><img class="student-passport"
                        src="{{ asset('assets/images/favicon.png') }}" alt="Student Passport"></th>
            </tr>
        </table>
    </div>
    <table class="result">
        <img style="opacity:.1;" class="photo"
            src="{{ asset('assets/images/favicon.png') }}"
            alt="Background Image">
        <tr>
            <td>
                <h4 style="text-align:center;">CANDIDATE EXAMINATION RESULT SLIP FOR SESSION {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}</h4>
            </td>
            <td colspan="2" style="text-align: right;"><img class="student-passport"
                    src="{{ asset('storage/'.$candidateInfo->passport) }}" alt="Student Passport"></td>
        </tr>
        <tr>
            <td>Examination No:</td>
            <td style="border-right: none">
                SOHELTECHA{{ !empty($candidateInfo->admissionnumber) ? $candidateInfo->admissionnumber : '.' }}
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
            <td>Session</td>
            <td style="border-right: none">
                {{ !empty($candidateInfo->session) ? $candidateInfo->session : 'null' }}
               
            </td>
            <td style="border-left: none"></td>
        </tr>


        <tr>
            <td>Course</td>
            <td colspan="2">
                {{ !empty($candidateInfo->candidateInstitution->firstchoicecourse) ? $candidateInfo->candidateInstitution->firstchoicecourse : 'no course found' }}
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
            <td>Date of Birth: </td>
            <td colspan="2">
                {{ !empty($candidateInfo->dateofbirth) ? $candidateInfo->dateofbirth : 'state of origin not found' }}
            </td>
        </tr>
        <tr>
            <td>Examination Score: </td>
            <td colspan="2">
                {{ !empty($candidateInfo->candidateresult->score) ? $candidateInfo->candidateresult->score : 'Check Back Soon' }}
            </td>
        </tr>

        <tr>
            <td>Cut-Off Mark:</td>
            <td colspan="2">
                    @php
        $courseName = $candidateInfo->candidateInstitution->firstchoicecourse;
        $stateOfOrigin = $candidateInfo->stateoforigin;

        $grad = DB::table('cut_offs')
            ->where('name', $courseName)
            ->when($stateOfOrigin === 'ONDO STATE', function ($query) {
                return $query->where('type', 1);
            }, function ($query) {
                return $query->where('type', 0);
            })
            ->pluck('cut_off')
            ->first();
    @endphp
    {{ $grad !== null ? $grad : 'null' }}
             </td>
        </tr>

        <tr>
            <td>Olevel Remark:</td>
            <td colspan="2">
                                              @php
    if (!function_exists('mapGradeToValue')) {
        function mapGradeToValue($grade) {
            switch ($grade) {
            case 'A1':
                return 5;
            case 'B2':
                return 4;
            case 'B3':
                return 3;
            case 'C4':
                return 3;
            case 'C5':
                return 2;
            case 'C6':
                return 1;
            case 'D7':
                return 1;
            case 'E8':
                return 0;
            case 'F9':
                return 0;
            default:
                return null; // Handle unknown grades
        }
        }
    }

    $grades = [
        $candidateInfo->candidateOlevel->grade_1,
        $candidateInfo->candidateOlevel->grade_2,
        $candidateInfo->candidateOlevel->grade_3,
        $candidateInfo->candidateOlevel->grade_4,
        $candidateInfo->candidateOlevel->grade_5,
        $candidateInfo->candidateOlevel->grade_6,
    ];
     $sum = array_reduce($grades, function ($carry, $grade) {
        return $carry + mapGradeToValue($grade);
    }, 0);
@endphp

{{$sum}}
            </td>
        </tr>
        <tr>
            <td>Result Remark: </td>
            <td colspan="2">
                @php
                                        $grade = DB::table('cut_offs')->where('name', $candidateInfo->candidateInstitution->firstchoicecourse)->pluck('cut_off')->first();
                                        $cutoff = !empty($grade) ? $grade : null;
                                        $mark = !empty($candidateInfo->candidateresult->score) ? $candidateInfo->candidateresult->score : null;
                                        
                                        if (isset($mark) && isset($cutoff) && $mark >= $cutoff) {
                                            echo "Qualified";
                                        } elseif (isset($mark) && isset($cutoff)) {
                                            echo "Unqualified";
                                        } else {
                                            if (is_null($cutoff) && is_null($mark)) {
                                                echo "Score or cutoff data missing";
                                            } elseif (is_null($cutoff)) {
                                                echo "Cutoff data missing";
                                            } elseif (is_null($mark)) {
                                                echo "Score data missing";
                                            }
                                        }
                                    @endphp
            </td>
        </tr>

        
        <tr>
            <th style="padding-top:2%; text-align:center; color:red" colspan="3"> </th>
        </tr>
    </table>
    <i style="float: right;">{{ $currentDateTime }}</i>
</body>

</html>
