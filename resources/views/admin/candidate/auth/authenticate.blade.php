@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 style="font-weight: 700;">Authenticate Using Pin And Serial Number</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Authentication</h3>
                            
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.candidate.auth.check') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="pin">Pin</label>
                                    <input type="text" class="form-control" name="pin" placeholder="Enter Pin">
                                </div>
                                <div class="form-group">
                                    <label for="serial_number">Serial Number</label>
                                    <input type="text" class="form-control" name="serial"
                                        placeholder="Enter Serial Number">
                                </div>
                                <button type="submit" class="btn btn-primary">Authenticate</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
