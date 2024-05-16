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
                    <h1 style="font-weight: 700;">UPDATE DEPARTMENT BLOG </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department Blog</li>
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
                    <h3 class="card-title">update blog</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                 <form action="{{ url('update/department/post/'.$post->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>DEPARTMENT</label>
                                    <select required name="name" class="form-control" style="width: 100%;">
                                        <option value=""> --Select Department-- </option>
                                        @foreach ($depart as $depart)
                                            <option value="{{ $depart->schoolname }}">{{ $depart->schoolname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ABOUT</label>
                                    <textarea placeholder="{{ $post->about }}" rows="3" required name="about" class="form-control" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>DESCRIPTION</label>
                                    <textarea rows="5" required placeholder="{{ $post->description }}" name="description" class="form-control" style="width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
   