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
            background-color: #717171d6;
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
            background-color: #007bff;
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
            margin-top: 2.5em;
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

    <div class="container">
        <p class="left">
            <a href=""><img src="{{ asset('assets/images/favicon.png') }}" alt=""
                    style="height: 5em; width:5em;"></a>
        </p>
        <p class="right">
            <a class="fa fa-sign-out" href="">logout</a>
        </p>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2 style="text-align: center;">Candidate Registration</h2>
                    </div>
                </div>
                
                <div class="card-description">
                    <p style="float: left">Logged in with card: {{ $pinnumber }} & {{ $serialnumber }}</p>
                    <p style="float: right">Entry type: Early entry</p>
                     
                </div><br><br><input style="display: none;" type="text" name="pinnumber" value="{{ $pinnumber }}">
                <form action="{{ route('candidate.save') }}"  enctype="multipart/form-data" id="registrationForm" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="step">
                        <input style="display: none;" type="text" name="pinnumber" value="{{ $pinnumber }}">
                        <input style="display: none;" type="text" name="serialnumber" value="{{ $serialnumber }}">
                        <input style="display: none;" type="text" name="access_coded" value="{{ $access_coded }}">
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
                                <label for="city">City:</label>
                                <input type="city" class="form-control" id="city" name="city" required>
                                <div class="invalid-feedback">Please enter your city.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="stateoforigin">State of Origin / Province / Region:</label>
                                <input type="stateoforigin" class="form-control" id="stateoforigin"
                                    name="stateoforigin" required>
                                <div class="invalid-feedback">Please enter your state of origin.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="localgovtorigin">Local Government Of Origin:</label>
                                <input type="localgovtorigin" class="form-control" id="localgovtorigin"
                                    name="localgovtorigin" required>
                                <div class="invalid-feedback">Please enter your local government of origin.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="country">Country:</label>
                                <input type="country" class="form-control" id="country" name="country" required>
                                <div class="invalid-feedback">Please enter your state of origin.</div>
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

                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    </div>

                    <!-- Step 2: Passport Upload Information -->
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
                                <label> <button style="float: right;" type="button" class="btn btn-success"
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
                                    <option value="1970">1970</option>
                                    <option value="1971">1971</option>
                                    <option value="1972">1972</option>
                                    <option value="1973">1973</option>
                                    <option value="1974">1974</option>
                                    <option value="1975">1975</option>
                                    <option value="1976">1976</option>
                                    <option value="1977">1977</option>
                                    <option value="1978">1978</option>
                                    <option value="1979">1979</option>
                                    <option value="1980">1980</option>
                                    <option value="1981">1981</option>
                                    <option value="1982">1982</option>
                                    <option value="1983">1983</option>
                                    <option value="1984">1984</option>
                                    <option value="1985">1985</option>
                                    <option value="1986">1986</option>
                                    <option value="1987">1987</option>
                                    <option value="1988">1988</option>
                                    <option value="1989">1989</option>
                                    <option value="1990">1990</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                </select>
                                <div class="invalid-feedback">Please select your from year.</div>
                            </div>
                            <div class="col-sm-6 col-md-6 form-group">
                                <label for="to">To (Year):</label>
                                <select class="form-control" id="to" name="to" required>
                                    <option value="1970">1970</option>
                                    <option value="1971">1971</option>
                                    <option value="1972">1972</option>
                                    <option value="1973">1973</option>
                                    <option value="1974">1974</option>
                                    <option value="1975">1975</option>
                                    <option value="1976">1976</option>
                                    <option value="1977">1977</option>
                                    <option value="1978">1978</option>
                                    <option value="1979">1979</option>
                                    <option value="1980">1980</option>
                                    <option value="1981">1981</option>
                                    <option value="1982">1982</option>
                                    <option value="1983">1983</option>
                                    <option value="1984">1984</option>
                                    <option value="1985">1985</option>
                                    <option value="1986">1986</option>
                                    <option value="1987">1987</option>
                                    <option value="1988">1988</option>
                                    <option value="1989">1989</option>
                                    <option value="1990">1990</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
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
                                    <option value="1970">1970</option>
                                    <option value="1971">1971</option>
                                    <option value="1972">1972</option>
                                    <option value="1973">1973</option>
                                    <option value="1974">1974</option>
                                    <option value="1975">1975</option>
                                    <option value="1976">1976</option>
                                    <option value="1977">1977</option>
                                    <option value="1978">1978</option>
                                    <option value="1979">1979</option>
                                    <option value="1980">1980</option>
                                    <option value="1981">1981</option>
                                    <option value="1982">1982</option>
                                    <option value="1983">1983</option>
                                    <option value="1984">1984</option>
                                    <option value="1985">1985</option>
                                    <option value="1986">1986</option>
                                    <option value="1987">1987</option>
                                    <option value="1988">1988</option>
                                    <option value="1989">1989</option>
                                    <option value="1990">1990</option>
                                    <option value="1991">1991</option>
                                    <option value="1992">1992</option>
                                    <option value="1993">1993</option>
                                    <option value="1994">1994</option>
                                    <option value="1995">1995</option>
                                    <option value="1996">1996</option>
                                    <option value="1997">1997</option>
                                    <option value="1998">1998</option>
                                    <option value="1999">1999</option>
                                    <option value="2000">2000</option>
                                    <option value="2001">2001</option>
                                    <option value="2002">2002</option>
                                    <option value="2003">2003</option>
                                    <option value="2004">2004</option>
                                    <option value="2005">2005</option>
                                    <option value="2006">2006</option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                </select>
                                <div class="invalid-feedback">Please enter your session.</div>
                            </div>
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
                        <button type="button" class="btn btn-primary prevBtn">Previous</button>
                        <button type="button" class="btn btn-primary nextBtn">Next</button>
                    </div>
    
                    <!-- Step 5: Preview and Submit -->
                    <div class="step" id="previewSection">
                        <h4>Acknowledgement Page <i class="fa fa-address-card"></i></h4>
                        <small style="font-weight: bold; color:red;">Please confirm all the information previously entered to
                            ensure your informations are correct.</small>
                        <div class="row">
                            <table style="border: 1px solid black; width:100%">
                                <thead style="border: 1px solid black;">
                                    <tr>
                                        <th colspan="3" style="text-align: center">CANDIDATE PERSONAL INFORMATION
                                        </th>
                                        <th style="text-align: center" colspan="3"><img id="previewImage" src="" alt="Profile Image" style="max-width: 200px;"></th>
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
        $(document).ready(function() {
            // When the department selection changes
            $('#department').change(function() {
                var selectedDepartment = $(this).val();
                var courseOptions = '';

                // Loop through the departments and find the selected department
                @foreach ($departments as $department)
                    if ("{{ $department->schoolname }}" === selectedDepartment) {
                        courseOptions +=
                            '<option value="{{ $department->coursename }}">{{ $department->coursename }}</option>';
                    }
                @endforeach

                // Update the course select element with the generated course options
                $('#course').html(courseOptions);
            });
        });
    </script>

    <script>
        var selectedSubjects = []; // Array to store selected subjects

        function validateSubject(subjectSelect) {
            var selectedSubject = subjectSelect.value;

            if (selectedSubjects.includes(selectedSubject)) {
                alert(selectedSubject + " is already selected!");
                subjectSelect.selectedIndex = 0; // Reset to the default option
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
            selectedSubjects = []; // Clear the selectedSubjects array

            var selects = document.getElementsByTagName("select");
            for (var i = 0; i < selects.length; i++) {
                selects[i].selectedIndex = 0; // Reset all select elements to the default option
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
                    reader.onload = function (e) {
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
</body>

</html>
