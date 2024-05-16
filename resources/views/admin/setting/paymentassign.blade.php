@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 style="font-weight: 700;">Payment Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Payment</li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <form action="{{ route('admin.payment.assign.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="typeId">
                                                <option value="">Select payment</option>
                                                @foreach ($paymentassigns as $paymentassign)
                                                    <option value="{{ $paymentassign->id }}">{{ $paymentassign->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select multiple class="form-control" name="department[]" id="typeId">
                                                <option value="">Select department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->schoolname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <select class="form-control" name="category" id="typeId">
                                                <option value="1">indigene</option>
                                                <option value="2">non-indigene</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="price">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <button class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('admin.payment.assign') }}" method="get">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <h3 class="card-title">Configuration</h3>
                                    </div>
                                    <div class="col-sm-4">
                                        <select name="payment_type" class="form-control">
                                            <option value="">All</option>
                                            @foreach ($paymentassigns as $paymentassign)
                                                <option value="{{ $paymentassign->id }}">{{ $paymentassign->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                         <select class="form-control" name="category" id="typeId">
                                             <option value="1">indigene</option>
                                            <option value="2">non-indigene</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-success">filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card-body">
                            <form action="{{ route('admin.payment.assign.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payment</th>
                                            <th>Category</th>
                                            <th>Department</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymentSettings->sortBy('payment_id') as $sitesetting)
                                            @php
                                                $paymenttype = DB::table('payments')
                                                    ->where('id', $sitesetting->payment_id)
                                                    ->pluck('name')
                                                    ->first();
                                                $department = DB::table('course_selection')
                                                    ->where('id', $sitesetting->department)
                                                    ->pluck('schoolname')
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $paymenttype }}
                                                </td>
                                                <td>
                                                    @if ($sitesetting->category == 1)
                                                        Indigene
                                                    @else
                                                        Non-indigene
                                                    @endif

                                                </td>
                                                <td class="text-left">
                                                    {{ $department }}
                                                </td>
                                                <td class="text-center">
                                                    <input type="text"
                                                        name="site_settings[{{ $sitesetting->id }}][price]"
                                                        class="form-control" value="{{ $sitesetting->price }}" required>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('admin.payment.assign.delete', ['id' => $sitesetting->id]) }}"
                                                        class="btn btn-danger show_confirm_edit"><i
                                                            class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-info">Update Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
