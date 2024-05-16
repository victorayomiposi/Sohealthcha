@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight: 700;">CREATE PROGRAMME </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Programme</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
             <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">add Programme</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('programme_save') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DEPARTMENT NAME</label>
                                     <select required name="department" id="session" class="form-control">
                                        <option value=""> --Select department-- </option>
                                        @foreach ($course as $course)
                                            <option value="{{ $course->id }}">{{ $course->schoolname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PROGRAMME</label>
                                    <input name="course" class="form-control" style="width: 100%;" required>
                                </div>   
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a style="float: right;" href="{{ route('dashboard') }}" class="btn btn-warning">Cancel</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
