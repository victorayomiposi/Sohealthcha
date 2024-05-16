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
                    <h1>UPDATE AGENT </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Agent Update</li>
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
                    <h3 class="card-title" style="font-weight: 700;">update Agent</h3>
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
                <form action="{{ route('update_agent', ['id' => $User->id]) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SURNAME</label>
                                    <input required name="surname" class="form-control" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>MIDDLE NAME</label>
                                    <input required name="middlename" class="form-control" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>FIRSTNAME</label>
                                    <input required name="firstname" class="form-control" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>BUSINESS NAME</label>
                                    <input value="{{ $User->business_name }}" required name="business_name" class="form-control" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>EMAIL ADDRESS</label>
                                    <input value="{{ $User->email }}" required name="email" class="form-control" style="width: 100%;">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PHONE NUMBER</label>
                                    <input value="{{ $User->phone }}" required type="text" name="phone" class="form-control" style="width: 100%;">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ADDRESS</label>
                                    <input value="{{ $User->address }}" required name="address" type="text" class="form-control"
                                        style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SESSION</label>
                                    <select name="session" id="session" class="form-control select2" style="width: 100%;">
                                        @php
                                            $currentYear = date('Y');
                                            $endYear = 2070;
                                        @endphp
                                        @for ($year = $currentYear; $year <= $endYear; $year++)
                                            @php
                                                $session = $year . '-' . ($year + 1);
                                            @endphp
                                            <option value="{{ $session }}">{{ $session }}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>



                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('view_agent') }}" style="float: right;" type="submit" class="btn btn-warning">Cancel</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>



        </div>

    </section>
@endsection
