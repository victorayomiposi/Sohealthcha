@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Filter form -->
    <form class="no-print" action="{{ route('resultview') }}" method="GET">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: 700;">APPLICANT RESULT VIEW</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="session">Session</label>
                            <select name="session" id="session" class="form-control">
                                <option value="">All Sessions</option>
                                @for ($year = 1940; $year <= 2050; $year++)
                                    <option value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="department" id="department" class="form-control">
                                <option value="">All Departments</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->schoolname }}">{{ $department->schoolname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select name="course" id="course" class="form-control">
                                <option value="">All Courses</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" name="search" id="search" class="form-control"
                                placeholder="Search...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="per_page">Results per Page</label>
                            <select name="per_page" id="per_page" class="form-control">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="500">500</option>
                                <option value="1000">1000</option>
                                <option value="2000">2000</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="per_page">filter</label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Applicant Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Applicant Result Table</h3>

        </div>
        <div class="card-body">

            <div class="card-header">
                <h3 class="card-title" style="font-weight:700;">

                    Total Number Of Candidates Applied for {{ $selectedsession }} course is: [{{ $candidate }} ].
                </h3>

                <button style="float: right;" class="btn btn-info" id="printButton">Print Table</button>

            </div>
            <form action="{{ route('transfer.admissions') }}" method="post">
                @csrf
                <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>FULLNAME</th>
                            <th>ADMIN. NO</th>
                            <th>SESSION</th>
                            <th>STATE</th>
                            <th>LGA</th>
                            <th>SCORE</th>
                            <th>PHONE</th>
                            <th>REMARK</th>
                            <th class="bg-success"></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidateInfo->sortByDesc('candidateresult.score') as $cand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ !empty($cand->surname) ? $cand->surname : 'null' }}
                                    {{ !empty($cand->firstname) ? $cand->firstname : 'null' }}
                                    {{ !empty($cand->othername) ? $cand->othername : 'null' }}
                                </td>
                                <td>
                                    @php
                                        $candexist = DB::table('pinstore')
                                            ->where('admissionnumber', $cand->admissionnumber)
                                            ->exists();
                                    @endphp
                                    @if ($candexist)
                                        <i style="background-color:white;">{{ $cand->admissionnumber }}</i>
                                    @else
                                        <i style="background-color:red;">{{ $cand->admissionnumber }}</i>
                                    @endif
                                </td>

                                <td>{{ $cand->session }}</td>
                                <td>{{ !empty($cand->stateoforigin) ? $cand->stateoforigin : 'null' }}</td>
                                <td>{{ !empty($cand->localgovtorigin) ? $cand->localgovtorigin : 'null' }}</td>
                                <td>{{ !empty($cand->candidateresult->score) ? $cand->candidateresult->score : 'Absent' }}
                                </td>
                                <td>{{ !empty($cand->phone) ? $cand->phone : 'null' }}</td>

                                <td>

                                    @php
                                        $indigene = $cand->stateoforigin == 'ONDO STATE';

                                        $course = $cand->candidateInstitution->firstchoicecourse;

                                        if ($indigene) {
                                            $type = 1;
                                        } else {
                                            $type = 0;
                                        }

                                        $grade = DB::table('cut_offs')
                                            ->where('name', $course)
                                            ->where('type', $type)
                                            ->pluck('cut_off')
                                            ->first();

                                        $cutoff = !empty($grade) ? $grade : null;
                                        $mark = !empty($cand->candidateresult->score)
                                            ? $cand->candidateresult->score
                                            : null;

                                        if (isset($mark) && isset($cutoff)) {
                                            if ($mark >= $cutoff) {
                                                echo 'Qualified';
                                            } else {
                                                echo 'Unqualified';
                                            }
                                        } else {
                                            if (is_null($cutoff) && is_null($mark)) {
                                                echo 'Score or cutoff data missing';
                                            } elseif (is_null($cutoff)) {
                                                echo 'Cutoff data missing';
                                            } elseif (is_null($mark)) {
                                                echo 'Score data missing';
                                            }
                                        }
                                    @endphp
                                    {{ $grade }}
                                </td>

                                <td>
                                    <input type="checkbox" id="transferCheckbox{{ $cand->id }}" name="transfer[]"
                                        value="{{ $cand->id }}">
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-success" type="submit">Admit Students</button>

            </form>
            @foreach ($candidateInfo->sortByDesc('candidateresult.score') as $cand)
                @php
                    $duplicates = DB::table('candidate_result')
                        ->where('session', $cand->session)
                        ->where('admissionnumber', $cand->admissionnumber)
                        ->get();

                    $count = $duplicates->count();
                @endphp
                <!--{{ $duplicates }}-->
                @if ($count > 1)
                    <!-- Modal for Duplicates -->
                    <div class="modal fade" id="modal-{{ $cand->admissionnumber }}" tabindex="-1" role="dialog"
                        aria-labelledby="modalLabel-{{ $cand->admissionnumber }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-{{ $cand->admissionnumber }}">
                                        Duplicate Admission Number: {{ $cand->admissionnumber }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('delete.duplicates') }}" method="get"
                                        id="deleteDuplicatesForm">
                                        @csrf
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($duplicates as $duplicate)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selectedDuplicates[]"
                                                                value="{{ $duplicate->result_id }}">
                                                        </td>
                                                        <td>{{ $duplicate->score }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger" id="deleteSelected">Delete
                                                Selected</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach



        </div>
        <div class="row ">
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging

_simple_numbers" id="example2_paginate">
                    {{ $candidateInfo->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById("toggleBtn").addEventListener("click", function() {
            var transferCheckbox = document.getElementById("transferCheckbox");
            var removeCheckbox = document.getElementById("removeCheckbox");

            if (!transferCheckbox.checked && !removeCheckbox.checked) {
                transferCheckbox.checked = true;
            } else if (transferCheckbox.checked && !removeCheckbox.checked) {
                transferCheckbox.checked = false;
                removeCheckbox.checked = true;
            } else if (!transferCheckbox.checked && removeCheckbox.checked) {
                transferCheckbox.checked = true;
                removeCheckbox.checked = false;
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#department').change(function() {
                var selectedDepartment = $(this).val();
                var courseOptions = '';

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
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#deleteSelected').click(function() {
                $('#deleteDuplicatesForm').submit();
            });
        });
    </script>
@endsection
