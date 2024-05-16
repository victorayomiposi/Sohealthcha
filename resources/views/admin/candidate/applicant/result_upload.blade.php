@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 style="font-weight: 700;">Upload Applicant Result</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Applicant / result / upload</li>
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
                    <div class="card-tools">
                        <form action="{{ route('export.template') }}" method="get">
                            <input type="hidden" name="selected_session" id="selected_session">
                            <button class="btn btn-success">Download Template</button>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SESSION</label>
                                    <select name="session" id="session" class="form-control">
                                        <option value="">All Sessions</option>
                                        @for ($year = 1940; $year <= 2050; $year++)
                                            <option value="{{ $year }}">
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BROWSE</label>
                                    <input name="file" type="file" class="form-control" style="width: 100%;" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a style="float: right;" href="{{ route('dashboard') }}"
                                        class="btn btn-warning">Cancel</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
         $('#session').change(function() {
             var selectedSession = $(this).val();
            
             $('#selected_session').val(selectedSession);
        });
    });
</script>

@endsection
