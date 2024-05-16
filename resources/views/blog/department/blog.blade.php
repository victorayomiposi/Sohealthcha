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
                    <h1 style="font-weight: 700;">CREATE DEPARTMENT CONTENT </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Content</li>
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
                 <form action="{{ route('departblog') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DEPARTMENT</label>
                                    <select required name="depart_id" class="form-control" style="width: 100%;">
                                        <option value=""> --Select Department-- </option>
                                        @foreach ($posts as $depart)
                                            <option value="{{ $depart->id }}">{{ $depart->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TITLE</label>
                                    <input required name="title" class="form-control" style="width: 100%;">
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
   