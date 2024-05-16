@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight: 700;">USER VIEW</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">User DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>FULLNAME</th>
                                        <th>BUSINESS</th>
                                        <th>ACCESS CODE</th>
                                        <th>PHONE</th>
                                         <th>SESSION</th>
                                        <th colspan="2">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Department as $Department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Department->fullname }}</td>
                                            <td>{{ $Department->business_name }}</td>
                                            <td>{{ $Department->access_code }}</td>
                                            <td>{{ $Department->phone }}</td>
                                             <td>{{ $Department->session }}</td>
                                            <td><a onclick="return confirm('Are you sure you want to edit ?')"
                                                    href="{{ url('panel/admin/agent/edit/' . $Department->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                            <td><a onclick="return confirm('Are you sure you want to delete ?')"
                                                    href="{{ url('panel/admin/agent/delete/' . $Department->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
