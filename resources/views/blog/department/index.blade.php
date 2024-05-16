@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-weight: 700;">BLOG VIEW</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Blog DataTables</li>
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
                            <h3 class="card-title">Department Blog</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>DEPARTMENT</th>
                                        <th>ABOUT</th>
                                        <th>DESCRIPTION</th>
                                        <th colspan="2">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $Department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $Department->name }}</td>

                                            <td><a data-toggle="modal" data-target="#departmentModal{{ $Department->id }}">
                                                    <i class="btn btn-default fa fa-eye"></i>
                                                </a></td>
                                            <td><a data-toggle="modal" data-target="#descriptionModal{{ $Department->id }}">
                                                    <i class="btn btn-default fa fa-eye"></i>
                                                </a></td>
                                            <td><a onclick="return confirm('Are you sure you want to edit ?')"
                                                    href="{{ url('panel/admin/department/blog/edit/' . $Department->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                            <td><a onclick="return confirm('Are you sure you want to delete ?')"
                                                    href="{{ url('panel/admin/department/blog/delete/' . $Department->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($posts as $Department)
        <div class="modal fade" id="departmentModal{{ $Department->id }}" tabindex="-1" role="dialog"
            aria-labelledby="departmentModalLabel{{ $Department->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="departmentModalLabel{{ $Department->id }}">Department Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $Department->about }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="descriptionModal{{ $Department->id }}" tabindex="-1" role="dialog"
            aria-labelledby="descriptionModalLabel{{ $Department->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalLabel{{ $Department->id }}">Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $Department->description }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
