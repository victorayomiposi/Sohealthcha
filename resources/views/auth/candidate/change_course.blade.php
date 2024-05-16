<!DOCTYPE html>
<html>

<head>
    <title>Change Of Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-image: url({{ asset('assets/images/background/bg2.jpg') }});
            background-size: cover;
        }

        .card {
            margin-top: 50px;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Reprint Authentication <i class="fa fa-user"></i></h5>
                    </div>

                    @if (session('error'))
                        <div class="card-header">
                            <div class="card-title" style="color: red;">{{ session('error') }}</div>
                        </div>
                    @endif
                     
                 <form action="{{ url('/update/change/course/'.$admissionnumber) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department">Department:</label>
                                    <select style="width: 100%;" class="form-control" id="department" name="department" required>
                                        <option value="">--Select department--</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->schoolname }}">{{ $department->schoolname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="padding-bottom: 2em;" class="col-md-6">
                                <div class="form-group">
                                    <label for="course">Course:</label>
                                    <select style="width: 100%;" class="form-control" id="course" name="course" required>
                                        <option value="">Select course</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button onclick="return confirm('You are about to make changes to your profile.')" type="submit"
                                        class="btn btn-primary">Update</button>
                                    <a style="float: right;" href="{{ url('/') }}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
</body>

</html>
