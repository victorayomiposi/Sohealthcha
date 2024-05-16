<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE CUT OFF MARK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url({{ asset('bgimage3.jpeg') }});
            background-size: cover;
            background-opacity: 0.8;
        }

        .login-container {
            max-width: 1000px;
            margin: auto;
            margin-top: 100px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>

</head>

<body>
    <div class="container text-center mt-5">
        <div class="login-container">
            <h4 style="font-weight:800;" class="text-success">UPDATE CUT OFF MARK </h4>
            <form action="{{ route('cut-off.update', $cutoff->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <select name="department" class="form-control" required>
                                <option value=""> --Select Department-- </option>
                                @foreach ($course as $course)
                                    <option value="{{ $course->coursename }}"
                                        {{ $cutoff->name == $course->coursename ? 'selected' : '' }}>
                                        {{ $course->coursename }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select name="type" class="form-control">
                                <option value=""> --Select Type-- </option>
                                <option value="1" {{ $cutoff->type == 1 ? 'selected' : '' }}>Indigene</option>
                                <option value="0" {{ $cutoff->type == 0 ? 'selected' : '' }}>Non-Indigene</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="cutoffmark">Cut Off Mark:</label>
                            <input type="number" name="cutoffmark" class="form-control" value="{{ $cutoff->cut_off }}"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-12 mt-5 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('cutoffmark_depart') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
