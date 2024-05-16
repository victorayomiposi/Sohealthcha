@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Filter form -->
    <form action="{{ route('olevel_status') }}" method="GET">
        <div class="card card-danger">
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
                                <!-- Add options for courses -->
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
            <h3 class="card-title">Applicant Table</h3>

        </div>
        <div class="card-body">

            <div class="card-header">
                <h3 class="card-title" style="font-weight:700;">Total Number of Registration for {{ $selectedsession }}
                    Exercise is.: {{ $candidate }}</h3>

                <button style="float: right;" class="btn btn-info" id="printButton">Print Table</button>

            </div>
            <table class="table table-bordered" style="font-size: 12px;">
                <!-- Table headings -->
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>FULLNAME</th>
                        <th>ADMIN. NO</th>
                        <th>SESSION</th>
                        <th>DEPARTMENT</th>
                        <th>COURSE</th>
                        <th style="text-align: center;" colspan="6">O*level Obtained</th>
                        {{--  <th colspan="" style="text-align: center; width: 5px; font-size:10px">Photocard</th>  --}}
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows -->
                    @foreach ($candidateInfo as $cand)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cand->surname }} {{ $cand->firstname }} {{ $cand->othername }}</td>
                            <td>{{ $cand->admissionnumber }}</td>
                            <td>{{ $cand->session }}</td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoiceschool) ? $cand->candidateInstitution->firstchoiceschool : 'no department found' }}
                            </td>
                            <td>{{ !empty($cand->candidateInstitution->firstchoicecourse) ? $cand->candidateInstitution->firstchoicecourse : 'no course found' }}
                            </td>

                            <td>{{ !empty($cand->candidateOlevel->subject_1) ? substr($cand->candidateOlevel->subject_1, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_1) ? $cand->candidateOlevel->grade_1 : '0' }})
                            </td>
                            <td>{{ !empty($cand->candidateOlevel->subject_2) ? substr($cand->candidateOlevel->subject_2, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_2) ? $cand->candidateOlevel->grade_1 : '0' }})
                            </td>
                            <td>{{ !empty($cand->candidateOlevel->subject_3) ? substr($cand->candidateOlevel->subject_3, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_3) ? $cand->candidateOlevel->grade_3 : '0' }})
                            </td>
                            <td>{{ !empty($cand->candidateOlevel->subject_4) ? substr($cand->candidateOlevel->subject_4, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_4) ? $cand->candidateOlevel->grade_4 : '0' }})
                            </td>
                            <td>{{ !empty($cand->candidateOlevel->subject_5) ? substr($cand->candidateOlevel->subject_5, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_5) ? $cand->candidateOlevel->grade_5 : '0' }})
                            </td>
                            <td>{{ !empty($cand->candidateOlevel->subject_6) ? substr($cand->candidateOlevel->subject_6, 0, 3) : '0' }}<br>({{ !empty($cand->candidateOlevel->grade_6) ? $cand->candidateOlevel->grade_6 : '0' }})
                            </td>
                            <td>
                                @php
                                    $sum = intval(!empty($cand->candidateOlevel->grade_1) ? $cand->candidateOlevel->grade_1 : 0) + intval(!empty($cand->candidateOlevel->grade_2) ? $cand->candidateOlevel->grade_2 : 0) + intval(!empty($cand->candidateOlevel->grade_3) ? $cand->candidateOlevel->grade_3 : 0);
                                @endphp

                                {{ $sum }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();

        });
    </script>
@endsection
