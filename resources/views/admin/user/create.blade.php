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
                    <h1 style="font-weight: 700;">CREATE USER </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">new user</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('user_save') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>FULLNAME</label>
                                    <input name="fullname" class="form-control" style="width: 100%;">
                                </div>

                            </div>
 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>USERNAME</label>
                                    <input name="username" class="form-control" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL ADDRESS</label>
                                    <input name="email" class="form-control" style="width: 100%;">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DEPARTMENT</label>
                                    <select name="depertment_id" class="form-control select2" style="width: 100%;">
                                        <option value="" selected="selected">Select Department</option>
                                        @foreach ($Department as $Department)
                                            <option value="{{ $Department->id }}">{{ $Department->schoolname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input name="password" type="password" class="form-control" style="width: 100%;">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TYPE</label>
                                    <select name="type" class="form-control select2" style="width: 100%;">
                                        <option value="Academic" selected="selected">Academic</option>
                                        <option value="Non-Academic">Non Academic</option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                 </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>



        </div>

    </section>
@endsection
