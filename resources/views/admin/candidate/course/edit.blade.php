@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight:700;">Change Of Course</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Course Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><p href="#">{{ $user->surname }} {{ $user->firstname }}
                          Department :  {{ $user->candidateInstitution->firstchoiceschool }}
                          Course :  {{ $user->candidateInstitution->firstchoicecourse }}</p></h3>
                    
                </div>


                <form action="{{ route('update_course', ['id' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course">Department:</label>
                                    <select style="width: 100%;" class="form-control" id="department" name="department"
                                        required>
                                        <option value=""> --Select department-- </option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->schoolname }}"
                                                {{ $user->candidateInstitution->firstchoiceschool == $user->candidateInstitution->firstchoiceschool ? 'selected' : '' }}>
                                                {{ $department->schoolname }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course">Course:</label>
                                    <select style="width: 100%;" class="form-control" id="course" name="course"
                                        required>
                                        <option value="{{ $user->candidateInstitution->firstchoicecourse }}">
                                            {{ $user->candidateInstitution->firstchoicecourse }}</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <button onclick="return confirm('You are about to make changes to this candidate')"
                                        type="submit" class="btn btn-primary">Change</button>
                                    <a style="float: right" href="{{ route('dashboard') }}"
                                        class="btn btn-warning">Cancel</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>



        </div>

    </section>
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
@endsection
