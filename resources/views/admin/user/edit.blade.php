@extends('admin.layout.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight: 700;">UPDATE USER </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Update</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">update user</h3>
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
                <form action="{{ route('update_user', ['id' => $User->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input value="{{ $User->fullname }}" name="fullname"  class="form-control" style="width: 100%;">
                                </div>
                             </div>

                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label>USERNAME</label>
                                    <input value="{{ $User->username }}" name="username" class="form-control"
                                        style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL ADDRESS</label>
                                    <input value="{{ $User->email }}" name="email" class="form-control"
                                        style="width: 100%;">
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
                                    <input name="password" type="password" class="form-control"
                                        style="width: 100%;">
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
                                    <button type="submit" class="btn btn-primary">Update</button>
                                 </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>



        </div>

    </section>
@endsection
