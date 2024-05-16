@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Filter form -->
    <form action="{{ route('view_applicant') }}" method="GET">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: 700;">APPLICANT VIEW</h3>
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
            <h3 class="card-title" style="font-weight:700;">Total Number of Registration for {{ $selectedsession }}
                Exercise is.: {{ $candidate }}</h3>

            <button style="float: right;" class="btn btn-info" id="printButton">Print Table</button>

        </div>

        <div class="card-body">
            <table id="printContainer" class="table table-bordered" style="font-size: 12px;">
                <!-- Table headings -->
                <thead>
                    <tr>
                        <th class="text-success" style="width: 10px">#</th>
                        <th class="text-success">Fullname</th>
                        <th class="text-success">Passport</th>
                        <th class="text-success">Admission</th>
                        <th class="text-success">Gender</th>
                        <th class="text-success">Phone</th>
                        <th class="text-success">Department</th>
                        <th class="text-success">Course</th>
                        <th class="text-success">Reg.Type</th>
                        <th class="text-success">Session</th>
                        <th class="text-success" colspan="" style="text-align: center; width: 5px; font-size:10px">
                            Photocard</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidateInfo as $cand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cand->surname }} {{ $cand->firstname }} {{ $cand->othername }}</td>
                            <td style="width: 10em;">
                                @if ($cand->passport)
                                    <a data-toggle="modal" data-target="#passportModal{{ $cand->id }}">
                                        <img src="{{ asset('storage/' . $cand->passport) }}" alt="Course Image"
                                            style="width: 5em; height: 5em;">
                                    </a>
                                @else
                                    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Default Image"
                                        style="width: 10em; height: 10em;">
                                @endif
                            </td>
                            <td>{{ $cand->admissionnumber }}</td>
                            <td>{{ $cand->gender }}</td>
                            <td><a data-toggle="modal" data-target="#departmentModal{{ $cand->id }}">
                                    <i class="btn btn-default text-success fa fa-eye"></i>
                                </a></td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoiceschool) ? $cand->candidateInstitution->firstchoiceschool : 'no department found' }}
                            </td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoicecourse) ? $cand->candidateInstitution->firstchoicecourse : 'no course found' }}
                            </td>

                            <td>
                                <span>
                                    @php
                                        $regtype = DB::table('pin_stores')->where('admissionnumber', $cand->admissionnumber)->first();
                                    @endphp
                                    @if (empty($regtype->customer_id))
                                        Manual
                                    @else
                                        Online
                                    @endif
                                </span>
                            </td>                          

                            <td>{{ $cand->session }}</td>
                            <td style="text-align: center;"><a
                                    href="{{ route('admin.photocard.print', ['id' => $cand->id]) }}" target="_blank"
                                    rel="noopener noreferrer"><i class="fa fa-print"></i></a></td>
                        </tr>


                        <div class="modal fade" id="departmentModal{{ $cand->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="departmentModal{{ $cand->id }}ModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="departmentModal{{ $cand->id }}Label">Edit
                                            Student
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">
                                                <img id="image-preview" src=""
                                                    style="width: 2em; height:2em; display:none">
                                            </span>
                                        </button>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">

                                                <i class="text-danger">&times;</i>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        departmentModal
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
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
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();

        });
    </script>
@endsection
