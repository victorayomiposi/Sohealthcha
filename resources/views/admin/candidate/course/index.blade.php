@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Filter form -->
    <form action="{{ route('applicantcourse') }}" method="GET">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: 700;">CHANGE OF COURSE</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="session">Session</label>
                            <select name="session" id="session" class="form-control">
                                <option value="">All Sessions</option>
                                @for ($year = 1940; $year <= 2050; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
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
            <h3 class="card-title">Applicant Table</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" style="font-size: 12px;">
                <!-- Table headings -->
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>FULLNAME</th>
                        <th>PASSPORT</th>
                        <th>GENDER</th>
                        <th>DEPARTMENT</th>
                        <th>COURSE</th>
                        <th>SESSION</th>
                        <th style="text-align: center; width: 5px; font-size:10px">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows -->
                    @foreach ($candidateInfo as $cand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cand->surname }} {{ $cand->firstname }} {{ $cand->othername }}</td>
                            <td style="width: 10em;">
                                @if ($cand->passport)
                                    <a data-toggle="modal" data-target="#passportModal{{ $cand->id }}">
                                        <img src="{{ asset('storage/' . $cand->passport) }}" alt="Course Image"
                                            style="width: 10em; height: 10em;">
                                    </a>
                                @endif
                            </td>
                            <td>{{ $cand->gender }}</td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoiceschool) ? $cand->candidateInstitution->firstchoiceschool : 'no department found' }}
                            </td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoicecourse) ? $cand->candidateInstitution->firstchoicecourse : 'no course found' }}
                            </td>
                            <td>{{ $cand->session }}</td>
                            <td style="text-align: center;"><a class="show_confirm_edit"
                                    href="{{ route('admin.edit.course', ['id' => $cand->id]) }}"><i
                                        class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @foreach ($candidateInfo as $cand)
            <div class="modal fade" id="passportModal{{ $cand->id }}" tabindex="-1" role="dialog"
                aria-labelledby="passportmodalLabel{{ $cand->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passportmodalLabel{{ $cand->id }}">CANDIDATE PASSPORT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="{{ asset('storage/' . $cand->passport) }}" alt="Course Image"
                                style="width: 10em; height:12em; padding:14px; margin-left:7em;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <!-- Pagination -->
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
@endsection
