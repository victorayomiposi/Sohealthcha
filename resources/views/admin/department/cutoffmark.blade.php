@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection
@section('content')
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">CUT OFF MARK CONFIGURATION</h3>
        </div>
        <form action="{{ route('cutoff.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <select name="department" class="form-control">
                            <option value=""> --Select Department-- </option>
                            @foreach ($course as $course)
                                <option value="{{ $course->coursename }}">{{ $course->coursename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="type" class="form-control">
                            <option value=""> --Select Type-- </option>
                            <option value="1">Indigene</option>
                            <option value="0">Non-Indigene</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input name="cutoffmark" type="number" class="form-control">
                    </div>
                    <div class="col-1">
                        <button type="submit" class="form-control btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cut-Off Config by Department</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>


                        <tr>
                            <th style="width: 10px">#</th>
                            <th>DEPARMENT NAME</th>
                            <th>

                                <form action="{{ route('cutoffmark_depart') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <select name="type" class="form-control">
                                                <option value=""> --ALL TYPE-- </option>
                                                <option value="1">INDIGENE</option>
                                                <option value="0">NON-INDIGENE</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="form-control btn btn-primary">Filter</button>
                                        </div>
                                    </div>

                                </form>
                            </th>

                            <th>CUT OFF MARK</th>
                            <th colspan="2" style="text-align:center width: 10px">ACTION</th>
                        </tr>

                    </thead>
                    <tbody>
                        @if ($cutoff !== null && count($cutoff) > 0)
                            @foreach ($cutoff as $individualCutoff)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $individualCutoff->name }}</td>
                                    <td>
                                        @if ($individualCutoff->type == 0)
                                            NON-INDIGENE
                                        @elseif($individualCutoff->type == 1)
                                            INDIGENE
                                        @elseif($individualCutoff->type == 'dept')
                                            NON-INDIGENE
                                        @endif
                                    </td>
                                    <td>{{ $individualCutoff->cut_off }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('cutoff_edit', ['id' => $individualCutoff->id]) }}"
                                            class="btn btn-warning show_confirm_edit"> <i class="fa fa-edit"></i></a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('cutoff_delete', ['id' => $individualCutoff->id]) }}"
                                            class="btn btn-danger show_confirm_delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <p>No cutoff data available.</p>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row">

                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        <ul class="pagination">

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>

    </div>
@endsection
