@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 style="font-weight: 700;">Site Settings</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Site</li>
                        <li class="breadcrumb-item active">Settings</li>
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
                            <h3 class="card-title">Configuration</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.site.config.store') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sitesettings->sortBy('code') as $sitesetting)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sitesetting->code }}</td>
                                                <td class="text-center">
                                                    <input type="text" name="site_settings[{{ $sitesetting->id }}][name]"
                                                        class="form-control" value="{{ $sitesetting->name }}"required>
                                                </td>
                                                <td class="text-center">
                                                    @if ($sitesetting->id == 4)
                                                        <select name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" required>
                                                            <option value="1"
                                                                {{ $sitesetting->price == 1 ? 'selected' : '' }}>Open
                                                            </option>
                                                            <option value="0"
                                                                {{ $sitesetting->price == 0 ? 'selected' : '' }}>Closed
                                                            </option>
                                                        </select>
                                                    @elseif($sitesetting->id == 6)
                                                        <input type="date"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}" required>
                                                    @elseif($sitesetting->id == 7)
                                                        <input type="password"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}"
                                                            required>
                                                    @elseif($sitesetting->id == 8)
                                                        <input type="password"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}"
                                                            required>
                                                    @elseif($sitesetting->id == 9)
                                                        <input type="password"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}"
                                                            required>
                                                    @else
                                                        <input type="text"
                                                            name="site_settings[{{ $sitesetting->id }}][price]"
                                                            class="form-control" value="{{ $sitesetting->price }}"
                                                            required>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
