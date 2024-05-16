<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url({{ asset('bgimage3.jpeg') }});
            background-size: cover;
            background-opacity: 0.8;
        }

        .container {
            background-color: #ffffff;
            margin-top: 1em;
            border-radius: 9px;
        }

        button {
            margin-top: 2em;
            margin-bottom: 2em;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 10px;
            font-size: 12px;

        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }


        .card {
            margin-top: 20px;
        }

        .card-header {
            background-color: #159a00;
            color: #fff;
        }

        .card-description {
            font-size: 12px;
            margin-top: 1em;
        }

        .right {
            float: right;
            margin-top: 2.5em;
        }

        .left {
            float: left;
            margin-top: 1.8em;
        }

        #image-preview-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #image-preview {
            padding-top: 3em;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>

<body>

    <div class="container col-md-11">
        <p class="left">
            <img src="{{ asset('assets/images/favicon.png') }}" alt="" style="height: 4em; width:4em;">
        </p>
        <p class="right">
            <a onclick="return confirm('Are you sure you want to logout?')" class="fa fa-sign-out"
                href="{{ route('online.candidate.logout') }}">Logout</a>
        </p>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header">
                        <h2 style="text-align: center;">Candidate Registration</h2>
                    </div>
                </div>

                <div class="card-description">
                    <p style="float: left; font-weight:300;font-size:15px">Logged in with card: <span
                            style="font-weight:800;color:red">{{ $pinnumber }}</span> & <span
                            style="font-weight:800;color:red">{{ $serialnumber }}</span></p>
                    <p style="float: right">Entry type: {{ $entrytype }} entry</p>

                </div><br><br>
                <form action="{{ route('online.candidate.store') }}" enctype="multipart/form-data" id="registrationForm"
                    method="post" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="entrytype" value="{{ $entrytype }}">
                    <div class="step">
                        <h4> Personal Information <i class="fa fa-user"></i></h4>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="surname">Surname:</label>
                                <input type="text" class="form-control" id="surname" name="surname" required>
                                <div class="invalid-feedback">Please enter your surname.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="firstName">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                <div class="invalid-feedback">Please enter your first Name.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="lastName">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                            <div class="col-
                            m-6 col-md-6 form-group">
                                <label for="lastName">Date Of Birth:</label>
                                <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" required>
                                <div class="invalid-feedback">Please enter your date of birth.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="gender">Gender:</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <div class="invalid-feedback">Please select your gender.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter your current address.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="address">Current Address:</label>
                                <input type="address" class="form-control" id="address" name="address" required>
                                <div class="invalid-feedback">Please enter your current address.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="country">Country:</label>
                                <select class="form-control" id="country" name="country" required>
                                    <option value="">Select Country</option>
                                    <option value="Nigeria">Nigeria</option>
                                </select>
                                <div class="invalid-feedback">Please enter your country.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="stateoforigin">State of Origin / Province / Region:</label>
                                <select class="form-control" id="stateoforigin" name="stateoforigin" required>
                                    <option value="">Select State of Origin</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please enter your state of origin.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="localgovtorigin">Local Government Of Origin:</label>
                                <select class="form-control" id="localgovtorigin" name="localgovtorigin" required>
                                </select>
                                <div class="invalid-feedback">Please enter your local government of origin.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="city">City:</label>
                                <input type="city" class="form-control" id="city" name="city" required>
                                <div class="invalid-feedback">Please enter your city.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="maritalstatus">Marital Status:</label>
                                <select class="form-control" id="maritalstatus" name="maritalstatus" required>
                                    <option value="">select status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                                <div class="invalid-feedback">Please select your marital status.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="placeofbirth">Place of Birth:</label>
                                <input type="placeofbirth" class="form-control" id="placeofbirth"
                                    name="placeofbirth" required>
                                <div class="invalid-feedback">Please enter your state of origin.</div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary nextBtn">Next <i fa fa-user></i></button>
                    </div>

                    <div class="step">
                        <h4>Passport Upload <i class="fa fa-user"></i></h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="phone">Passport:</label>
                                <input type="file" id="image-input" class="form-control" id="phone"
                                    name="passport" required>
                                <div class="invalid-feedback">Please select your passport.</div>
                                <img id="image-preview">
                            </div>
                        </div>
                        <h4>Next of Kins Information <i class="fa fa-user"></i></h4>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="kinsurname">Surname:</label>
                                <input type="text" class="form-control" id="kinsurname" name="kinsurname"
                                    required>
                                <div class="invalid-feedback">Please enter your surname.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="kinfirstname">First Name:</label>
                                <input type="text" class="form-control" id="kinfirstname" name="kinfirstname"
                                    required>
                                <div class="invalid-feedback">Please enter your first Name.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="kinsothername">Last Name:</label>
                                <input type="text" class="form-control" id="kinsothername" name="kinsothername"
                                    required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="kinsphone">Phone Number:</label>
                                <input type="text" class="form-control" id="kinsphone" name="kinsphone" required>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning prevBtn">Previous</button>
                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    </div>

                    <!-- Step 3:Next of Kins Information-->
                    <div class="step">
                        <h4>Candidate OLevel <i class="fa fa-file"></i></h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="entry_type">Entry Type:</label>
                                <select id="entry_type" onchange="toggleHiddenInputs()" class="form-control"
                                    name="entry_type" required>
                                    <option value="">select entry type</option>
                                    <option value="normal">Normal</option>
                                    <option value="jamb">Jamb</option>
                                </select>
                                <div class="invalid-feedback">Please select your entry type.</div>
                            </div>
                            <div style="display: none;" class="hidden-input col-sm-6 col-md-6 form-group">
                                <label for="utme_exam_no">JAMB Examination Number:</label>
                                <input type="text" class="form-control " name="utme_exam_no">
                            </div>
                            <div style="display: none;" class="hidden-input col-sm-6 col-md-6 form-group">
                                <label for="aggregate_score">Aggregate Score:</label>
                                <input type="text" class="form-control " name="aggregate_score">
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="examboard">Examination Board:</label>
                                <select class="form-control" id="examboard" name="examboard" required>
                                    <option value="">-- Select Exam Board --</option>
                                    <option value="SSCE">SSCE</option>
                                    <option value="NECO">NECO</option>
                                    <option value="GCE">NABTEB</option>
                                    <option value="NABTEB">NABTEB</option>
                                </select>
                                <div class="invalid-feedback">Please select your marital status.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="examnumber">OLevel Examination Number:</label>
                                <input type="text" class="form-control" id="examnumber" name="examnumber"
                                    required>
                                <div class="invalid-feedback">Please enter your olevel examination number.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject1">Subject</label>
                                <select class="form-control" name="subject1" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>
                                    <option value="CHEMISTRY">CHEMISTRY</option>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade1">Grade</label>
                                <select class="form-control" name="grade1" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject2">Subject</label>
                                <select class="form-control" name="subject2" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>
                                    <option value="CHEMISTRY">CHEMISTRY</option>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade2">Grade</label>
                                <select class="form-control" name="grade2" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject3">Subject</label>
                                <select class="form-control" name="subject3" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>
                                    <option value="CHEMISTRY">CHEMISTRY</option>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade3">Grade</label>
                                <select class="form-control" name="grade3" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject4">Subject</label>
                                <select class="form-control" name="subject4" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>
                                    <option value="CHEMISTRY">CHEMISTRY</option>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade4">Grade</label>
                                <select class="form-control" name="grade4" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject5">Subject</label>
                                <select class="form-control" name="subject5" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>n>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade5">Grade</label>
                                <select class="form-control" name="grade5" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="subject6">Subject</label>
                                <select class="form-control" name="subject6" id="subjectSelect"
                                    onchange="validateSubject(this)" required>
                                    <option value="">-- Select Subject --</option>
                                    <option value="ACCOUNTS">ACCOUNTS</option>
                                    <option value="AGRICULTURAL SCIENCE">AGRICULTURAL SCIENCE</option>
                                    <option value="BIOLOGY">BIOLOGY</option>
                                    <option value="CHEMISTRY">CHEMISTRY</option>
                                    <option value="COMMERCE">COMMERCE</option>
                                    <option value="ECONOMICS">ECONOMICS</option>
                                    <option value="ENGLISH LANGUAGE">ENGLISH LANGUAGE</option>
                                    <option value="FINE ART">FINE ART</option>
                                    <option value="FOOD &amp; NUTRITION">FOOD &amp; NUTRITION</option>
                                    <option value="FURTHER MATHEMATICS">FURTHER MATHEMATICS</option>
                                    <option value="GEOGRAPHY">GEOGRAPHY</option>
                                    <option value="GOVERNMENT">GOVERNMENT</option>
                                    <option value="HEALTH SCIENCE">HEALTH SCIENCE</option>
                                    <option value="LIT-IN-ENGLISH">LIT-IN-ENGLISH</option>
                                    <option value="MATHEMATICS">MATHEMATICS</option>
                                    <option value="PHYSICS">PHYSICS</option>
                                    <option value="SOCIAL SCIENCE">SOCIAL SCIENCE</option>
                                </select>
                                <div class="invalid-feedback">Please select your subject.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="grade6">Grade</label>
                                <select class="form-control" name="grade6" id="grade2" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="A1">A1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="C4">C4</option>
                                    <option value="C5">C5</option>
                                    <option value="C6">C6</option>
                                    <option value="D7">D7</option>
                                    <option value="E8">E8</option>
                                    <option value="F9">F9</option>
                                    <option value="AR">AR</option>
                                </select>
                                <div class="invalid-feedback">Please select your grade.</div>
                            </div>
                            <div class="col-sm-12 col-md-12 form-group">
                                <label> <button style="float: right;" type="button" class="btn btn-danger"
                                        onclick="resetSelects()">Reset
                                        Table</button></label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning prevBtn">Previous</button>
                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    </div>
                    <!-- Academics History-->
                    <div class="step">
                        <h4>Academics History <i class="fa fa-book"></i></h4>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 form-group">
                                <label for="institution">Name of Institution Attended:</label>
                                <input type="text" class="form-control" id="institution" name="institution"
                                    required>
                                <div class="invalid-feedback">Please enter name of institution attended.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="from">From (Year):</label>
                                <select class="form-control" id="from" name="from" required>
                                    @for ($year = 1940; $year <= 2050; $year++)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="invalid-feedback">Please select your from year.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="to">To (Year):</label>
                                <select class="form-control" id="to" name="to" required>
                                    @for ($year = 1940; $year <= 2050; $year++)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="invalid-feedback">Please select your to year.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="qualification">Qualification:</label>
                                <input type="text" class="form-control" id="qualification" name="qualification"
                                    required>
                                <div class="invalid-feedback">Please enter your qualification.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="session">Session:</label>
                                <select class="form-control" id="session" name="session" required>
                                    @for ($year = 1940; $year <= 2050; $year++)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                <div class="invalid-feedback">Please enter your session.</div>
                            </div>
                            <input type="hidden" name="id" value="{{ $id }}">
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="department">Department:</label>
                                <select class="form-control" id="department" name="department" required>
                                    <option value=""> --Select department-- </option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->schoolname }}">{{ $department->schoolname }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select your department.</div>
                            </div>

                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="course">Course:</label>
                                <select class="form-control" id="course" name="course" required>
                                    <option value="">Select course</option>
                                </select>
                                <div class="invalid-feedback">Please select your course.</div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning prevBtn">Previous</button>
                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    </div>

                    <!-- Step 5: Preview and Submit -->
                    <div class="step" id="previewSection">
                        <h4>Acknowledgement Page <i class="fa fa-address-card"></i></h4>
                        <small style="font-weight: bold; color:red;">Please confirm all the information previously
                            entered to
                            ensure your informations are correct.</small>
                        <div class="row">
                            <table style="border: 1px solid black; width:100%">
                                <thead style="border: 1px solid black;">
                                    <tr>
                                        <th colspan="3" style="text-align: center">CANDIDATE PERSONAL INFORMATION
                                        </th>
                                        <th style="text-align: center" colspan="3"><img id="previewImage"
                                                src="" alt="Profile Image" style="max-width: 200px;"></th>
                                    </tr>
                                </thead>
                                <tbody style="border: 1px solid black;">
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Name of Candidate</td>
                                        <td i colspan="3"><span id="previewsurname"></span> <span
                                                id="previewFirstName"></span> <span id="previewLastName"></span> </td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Date of Birth</td>
                                        <td colspan="3"><span id="previewdateofbirth"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Gender</td>
                                        <td colspan="3"><span id="previewgender"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Phone Number</td>
                                        <td colspan="3"><span id="previewphone"></span></td>
                                    </tr style="border: 1px solid black;">
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Email Address</td>
                                        <td colspan="3"><span id="previewEmail"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Contact Address</td>
                                        <td colspan="3"><span id="previewaddress"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">City</td>
                                        <td colspan="3"><span id="previewCity"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Local Government of Origin</td>
                                        <td colspan="3"><span id="previewLocalGovtOrigin"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3"> Nationality</td>
                                        <td colspan="3"><span id="previewcountry"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3"> State of Origin </td>
                                        <td colspan="3"><span id="previewStateOfOrigin"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3"> Marital Status</td>
                                        <td colspan="3"><span id="previewMaritalStatus"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3">Place of Birth</td>
                                        <td colspan="3"><span id="previewPlaceOfBirth"></span></td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <th colspan="6">CANDIDATE NEXT OF KINS INFORMATION</th>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3"> Next of Kins Name</td>
                                        <td colspan="3">Next of Kins Phone Number</td>
                                    </tr>
                                    <tr style="border: 1px solid black;">
                                        <td colspan="3"><span id="previewKinSurname"></span> <span
                                                id="previewKinFirstName"></span> <span
                                                id="previewKinOtherName"></span></td>
                                        <td colspan="3">
                                            <spa id="previewKinPhone"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="6">CANDIDATE ACADEMIC HISTORY</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">NAME OF INSTITUTION ATTENDED</th>
                                        <th>FROM (YEAR)</th>
                                        <th>TO (YEAR)</th>
                                        <th>QUALIFICATION</th>
                                        <th>DATES</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><span id="previewInstitution"></span></td>
                                        <td><span id="previewFromDate"></span></td>
                                        <td><span id="previewToDate"></span></td>
                                        <td><span id="previewQualification"></span></td>
                                        <td><span id="previewSession"></span></td>
                                    </tr>

                                    <tr>
                                        <th colspan="6">CANDIDATE CHOICE OF DEPARTMENT & COURSE</th>
                                    </tr>
                                    <tr>
                                        <th colspan="3">Department</th>
                                        <th colspan="3">Course</th>

                                    </tr>
                                    <tr>
                                        <td colspan="3"><span id="previewDepartment"></span></td>
                                        <td colspan="4"><span id="previewCourse"></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary prevBtn">Previous</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        var selectedSubjects = [];

        function validateSubject(subjectSelect) {
            var selectedSubject = subjectSelect.value;

            if (selectedSubjects.includes(selectedSubject)) {
                alert(selectedSubject + " is already selected!");
                subjectSelect.selectedIndex = 0;
            } else {
                var previousSubject = subjectSelect.getAttribute("data-previous-subject");
                if (previousSubject && selectedSubjects.includes(previousSubject)) {
                    var index = selectedSubjects.indexOf(previousSubject);
                    selectedSubjects.splice(index, 1); // Remove previous subject from the array
                }
                selectedSubjects.push(selectedSubject);
                subjectSelect.setAttribute("data-previous-subject", selectedSubject);
            }
        }

        function resetSelects() {
            selectedSubjects = [];

            var selects = document.getElementsByTagName("select");
            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0;
            }
        }
    </script>
    <script>
        function toggleHiddenInputs() {
            var selectElement = document.getElementById("entry_type");
            var hiddenInputs = document.getElementsByClassName("hidden-input");

            if (selectElement.value === "jamb") {
                for (var i = 0; i < hiddenInputs.length; i++) {
                    hiddenInputs[i].style.display = "block";
                }
            } else {
                for (var i = 0; i < hiddenInputs.length; i++) {
                    hiddenInputs[i].style.display = "none";
                }
            }
        }
    </script>
    <script>
        // Get the file input element
        var imageInput = document.getElementById('image-input');

        // Get the image preview element
        var imagePreview = document.getElementById('image-preview');

        // Listen for changes in the file input
        imageInput.addEventListener('change', function(e) {
            // Get the selected file
            var file = e.target.files[0];

            // Create a FileReader object
            var reader = new FileReader();

            // Set the image source once it's loaded
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };

            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        });
    </script>
    <script>
        $(document).ready(function() {
            var currentStep = 0;
            var steps = $(".step");

            // Hide all steps except the first one
            steps.not(":eq(0)").hide();

            $(".nextBtn").on("click", function() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    steps.hide().eq(currentStep).show();
                }
            });

            $(".prevBtn").on("click", function() {
                currentStep--;
                steps.hide().eq(currentStep).show();
            });

            $(".nextBtn:last").on("click", function() {
                event.preventDefault();
                if (validateStep(currentStep)) {
                    // Collect and display the preview data
                    var firstName = $("#firstName").val();
                    var surname = $("#surname").val();
                    var lastName = $("#lastName").val();
                    var dateofbirth = $("#dateofbirth").val();
                    var email = $("#email").val();
                    var phone = $("#phone").val();
                    var address = $("#address").val();
                    var gender = $("#gender").val();
                    var country = $("#country").val();
                    var city = $("#city").val();
                    var stateOfOrigin = $("#stateoforigin").val();
                    var localGovtOrigin = $("#localgovtorigin").val();
                    var maritalStatus = $("#maritalstatus").val();
                    var placeOfBirth = $("#placeofbirth").val();
                    var image = $("#image-input").val();
                    var kinSurname = $("#kinsurname").val();
                    var kinFirstName = $("#kinfirstname").val();
                    var kinOtherName = $("#kinsothername").val();
                    var kinPhone = $("#kinsphone").val();
                    var institution = $("#institution").val();
                    var fromDate = $("#from").val();
                    var toDate = $("#to").val();
                    var qualification = $("#qualification").val();
                    var session = $("#session").val();
                    var department = $("#department").val();
                    var course = $("#course").val();
                    var profileImage = $("#image-input").prop("files")[0];

                    $("#previewFirstName").text(firstName);
                    $("#previewsurname").text(surname);
                    $("#previewLastName").text(lastName);
                    $("#previewdateofbirth").text(dateofbirth);
                    $("#previewcountry").text(country);
                    $("#previewEmail").text(email);
                    $("#previewgender").text(gender);
                    $("#previewphone").text(phone);
                    $("#previewaddress").text(address);
                    $("#previewCity").text(city);
                    $("#previewStateOfOrigin").text(stateOfOrigin);
                    $("#previewLocalGovtOrigin").text(localGovtOrigin);
                    $("#previewMaritalStatus").text(maritalStatus);
                    $("#previewPlaceOfBirth").text(placeOfBirth);
                    $("#previewImage").attr("src", image);
                    $("#previewKinSurname").text(kinSurname);
                    $("#previewKinFirstName").text(kinFirstName);
                    $("#previewKinOtherName").text(kinOtherName);
                    $("#previewKinPhone").text(kinPhone);
                    $("#previewInstitution").text(institution);
                    $("#previewFromDate").text(fromDate);
                    $("#previewToDate").text(toDate);
                    $("#previewQualification").text(qualification);
                    $("#previewSession").text(session);
                    $("#previewDepartment").text(department);
                    $("#previewCourse").text(course);
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#previewImage").attr("src", e.target.result);
                    };
                    reader.readAsDataURL(profileImage);

                    $(this).unbind("submit").submit();
                    steps.hide();
                    $("#previewSection").show();
                }
            });

            function validateStep(step) {
                var isValid = true;
                var currentStepFields = steps.eq(step).find(":input");

                currentStepFields.each(function() {
                    if (!this.checkValidity()) {
                        $(this).addClass("is-invalid");
                        isValid = false;
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

                return isValid;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#stateoforigin').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.get('/get-lgas/' + stateId, function(data) {
                        $('#localgovtorigin').empty().append(
                            '<option value="">Select Local Government Of Origin</option>');
                        $.each(data, function(key, value) {
                            $('#localgovtorigin').append('<option value="' + value.name +
                                '">' + value
                                .name + '</option>');
                        });
                    });
                } else {
                    $('#localgovtorigin').empty().append(
                        '<option value="">Select Local Government Of Origin</option>');
                }
            });

            $('#department').change(function() {
                var departmentId = $(this).val();
                if (departmentId) {
                    $.get('/get-department/' + departmentId, function(data) {
                        $('#course').empty().append(
                            '<option value="">Select Course</option>');
                        $.each(data, function(key, value) {
                            $('#course').append('<option value="' + value.coursename +
                                '">' + value
                                .coursename + '</option>');
                        });
                    });
                } else {
                    $('#course').empty().append(
                        '<option value="">Select Course</option>');
                }
            });
        });
    </script>
</body>

</html>
