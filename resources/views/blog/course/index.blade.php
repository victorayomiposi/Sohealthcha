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
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Course Blog</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>COURSE</th>
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
                                            <td>
                                                @if ($Department->images)
                                                    <!-- Display the image if it exists -->
                                                    <img src="{{ asset('storage/course_images/' . $Department->images) }}"
                                                        alt="Course Image" style="max-width: 100%;">
                                                @else
                                                    {{--  <!-- Show a default image if no image is available -->
                                                <img src="{{ asset('course_images/default_image.jpg') }}" alt="Default Image" style="max-width: 100%;">  --}}
                                                @endif
                                            </td>
                                            <td>{{ $Department->description }}</td>
                                            <td><a onclick="return confirm('Are you sure you want to edit ?')"
                                                    href="{{ url('panel/admin/course/blog/edit/' . $Department->id) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                            <td><a onclick="return confirm('Are you sure you want to delete ?')"
                                                    href="{{ url('panel/admin/course/blog/delete/' . $Department->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
    
@endsection
