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
                                        <th>DEPARTMENT</th>
                                        <th>USERNAME</th>
                                        <th>EMAIL</th>
                                        <th>STATUS</th>
                                        <th colspan="2">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminuser as $users)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $users->fullname }}</td>
                                            <td>{{ optional($users->department)->schoolname }}</td>
                                            <td>{{ $users->username }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->type }}</td>
                                            <td><a href="{{ route('admin.edit.user', ['id' => $users->id]) }}"
                                                    class="btn btn-warning show_confirm_edit"><i class="fa fa-edit"></i></a>
                                            </td>
                                            <td><a href="{{ route('admin.delete.user',['id' => $users->id]) }}"
                                                    class="btn btn-danger show_confirm_delete"><i class="fa fa-trash"></i></a>
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
