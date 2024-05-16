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
                        <form action="{{ route('admin.payment.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name"
                                                placeholder="enter your payment name here">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="typeId">
                                                <option value="">Select Method</option>
                                                <option value="1">General Payments</option>
                                                <option value="0">Department Payments</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 additional-input2">
                                        <div class="form-group">
                                            <select class="form-control" name="category" id="typeId">
                                                <option value="0">All</option>
                                                <option value="1">indigene</option>
                                                <option value="2">non-indigene</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2 additional-input">
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
                        <div class="card-header">
                            <h3 class="card-title">Configuration</h3>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Payment</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymentsettings->sortBy('code') as $sitesetting)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($sitesetting->type == 1)
                                                        General Payments
                                                    @else
                                                        Department Payments
                                                    @endif
                                                </td> 
                                                <td>
                                                    @if ($sitesetting->category == 0)
                                                        All
                                                    @elseif ($sitesetting->category == 1)
                                                        Indigene
                                                    @elseif ($sitesetting->category == 2)
                                                        Non-indigene
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="site_settings[{{ $sitesetting->id }}][name]"
                                                        class="form-control" value="{{ $sitesetting->name }}"required>
                                                </td>
                                                @if ($sitesetting->type == 1)
                                                    <td class="text-center">
                                                        <input type="text"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}" required>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <a href="{{ route('admin.payment.assign') }}"
                                                            class="btn btn-primary">Assign department</a>
                                                    </td>
                                                @endif

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.additional-input').hide();
            $('.additional-input2').hide();

            $('#typeId').change(function() {
                if ($(this).val() == '0') {
                    $('.additional-input').hide();
                    $('.additional-input2').hide();
                } else {
                    $('.additional-input').show();
                    $('.additional-input2').show();

                }
            });
        });
    </script>
@endsection
