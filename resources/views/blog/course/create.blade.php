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
                    <h1 style="font-weight: 700;">CREATE COURSE BLOG </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Course Blog</li>
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
                    <h3 class="card-title">new blog</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                 <form action="{{ route('course_post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>COURSE</label>
                                    <select required name="name" class="form-control" style="width: 100%;">
                                        <option value=""> --Select Course-- </option>
                                        @foreach ($depart as $depart)
                                            <option value="{{ $depart->coursename }}">{{ $depart->coursename }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IMAGE</label>
                                    <input type="file" required name="images" class="form-control" style="width: 100%;"></input>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ABOUT</label>
                                    <textarea rows="3" required name="about" class="form-control" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>DESCRIPTION</label>
                                    <textarea rows="5" required name="description" class="form-control" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('dashboard') }}" style="float: right;" type="submit" class="btn btn-warning">Cancel</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

    </section>
@endsection
   