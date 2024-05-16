@extends('admin.layout.app')
@section('content')
    <style>
        .card {
            border: none;
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 3rem;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        .bg-info {
            background-color: #17a2b8 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="text-primary" style="font-weight: 700;">WELCOME TO ONDO STATE COLLECGE OF HEALTH TECHNOLOGY
                        AKURE</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="admincount"></h3>

                            <p>Total Administrator User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer"> For Current Session :
                            <span id="year"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="admittedcandidate"></h3>
                            <p>Total Student</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer"> For Current Session :
                            <span id="year2"></span>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="departmentcount"></h3>

                            <p>Total Available Department</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <a href="#" class="small-box-footer"> For Current Session :
                            <span id="year3"></span>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="applicantcount"></h3>
                            <p>Total Applicants</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer"> For Session :
                            <span id="year4"></span>
                        </a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <i class="text-success fas fa-user card-icon mr-3"></i>
                            <div>
                                <h4 class="card-title"><a href="{{ route('admin.candidate.auth.index') }}"
                                        class="text-dark text-bold">Applicants
                                        Registration</a></h4>
                                <p class="card-text text-primary"><a href="{{ route('admin.candidate.auth.index') }}"
                                        target="_blank" rel="noopener noreferrer">Click here to register your applicant.</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <i class="text-success fas fa-id-card card-icon mr-3"></i>
                            <div>
                                <h4 class="card-title"><a href="{{ route('reprint_photocard') }}"
                                        class="text-dark text-bold">Reprint
                                        Photocard</a></h4>
                                <p class="card-text text-primary"><a href="{{ route('reprint_photocard') }}" target="_blank"
                                        rel="noopener noreferrer">Click here to reprint your photocard.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <i class="text-success fas fa-exchange-alt card-icon mr-3"></i>
                            <div>
                                <h4 class="card-title"><a href="{{ route('changecourse') }}"
                                        class="text-dark text-bold">Change Of
                                        Course Request</a></h4>
                                <p class="card-text text-primary"><a href="{{ route('changecourse') }}" target="_blank"
                                        rel="noopener noreferrer">Click here to request a change of course.</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 mb-6">
                    <div class="card h-100 bg-light">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <i class="text-success fas fa-exchange-alt card-icon mr-3"></i>
                            <div>
                                <h4 class="card-title"><a href="{{ route('candidate_acceptance') }}"
                                        class="text-dark text-bold">Check Acceptance
                                        Letter</a></h4>
                                <p class="card-text text-primary"><a href="{{ route('candidate_acceptance') }}"
                                        target="_blank" rel="noopener noreferrer">Click here to check your acceptance
                                        letter.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-6">
                    <div class="card h-100 bg-light">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <i class="text-success far fa-calendar-alt card-icon mr-3"></i>
                            <div>
                                <h4 class="card-title"><a href="{{ route('candidate_admission') }}"
                                        class="text-dark text-bold">Check
                                        Admission</a></h4>
                                <p class="card-text text-primary"><a href="{{ route('candidate_admission') }}"
                                        target="_blank" rel="noopener noreferrer">Click here to check your admission
                                        status.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                fetch("{{ route('dashboard.statistic') }}")
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById('admincount').innerText = data.admincount;
                            document.getElementById('departmentcount').innerText = data.departmentcount;
                            document.getElementById('applicantcount').innerText = data.applicantcount;
                            document.getElementById('admittedcandidate').innerText = data.admittedcandidate;
                            document.getElementById('year').innerText = data.year;
                            document.getElementById('year2').innerText = data.year;
                            document.getElementById('year3').innerText = data.year;
                            document.getElementById('year4').innerText = data.year;

                        } else {
                            // If data is not available, set values to 0 or any default value
                            document.getElementById('admincount').innerText = '0';
                            document.getElementById('departmentcount').innerText = '0';
                            document.getElementById('applicantcount').innerText = '0';
                            document.getElementById('admittedcandidate').innerText = '0';
                            document.getElementById('year').innerText = '0';
                            document.getElementById('year2').innerText = '0';
                            document.getElementById('year3').innerText = '0';
                            document.getElementById('year4').innerText = '0';

                        }
                    })
                    .catch(error => console.error('Error fetching dashboard data:', error));
            });
        </script>
    @endsection
