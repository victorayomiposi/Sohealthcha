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
                    <h1>SET EXAM DATE </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">set exam date</li>
                    </ol>
                </div>
            </div>
        </div> 
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">new exam date</h3>
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
                <form action="{{ route('examdate_save') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Examination Date</label>
                                    <input type="date" required name="exam_date" class="form-control" style="width: 100%;">
                                </div>
                                 
                            </div>

                             
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SESSION</label>
                                    <select required name="session" id="session" class="form-control select2" style="width: 100%;">
                                        @php
                                            $currentYear = date('Y');
                                            $endYear = 2070;
                                        @endphp
                                        @for ($year = $currentYear; $year <= $endYear; $year++)
                                            @php
                                                $session = $year;
                                            @endphp
                                            <option value="{{ $session }}">{{ $session }}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Set Exam Date</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>



        </div>

    </section>
@endsection
