@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection
@section('content')
    <div class="card card-danger">
        <div class="card-header">
            <h3  class="card-title no-print">GENERATE CHANGE OF COURSE PIN</h3>
        </div>
        <form class="no-print" action="{{ route('course.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <select required name="amount" class="form-control">
                            <option value=""> --Select Amount-- </option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select required name="course" class="form-control">
                            <option value=""> --Select Course-- </option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->coursename }}">{{ $department->coursename }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-3">
                        <input placeholder="Enter Length" name="length" type="number" id="myNumber" oninput="checkNumber()" min="1"
                            max="15" class="form-control">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="form-control btn btn-info">Generate</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-header bg-secondary no-print">
            <h3 class="card-title">FILTER CHANGE OF COURSE PIN</h3>
        </div>
        <form class="no-print" action="{{ route('course_pin') }}" method="GET">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <select name="per_page" class="form-control">
                            <option value="20" @if(request('per_page') == '20') selected @endif>20</option>
                            <option value="50" @if(request('per_page') == '50') selected @endif>50</option>
                            <option value="100" @if(request('per_page') == '100') selected @endif>100</option>
                            <option value="200" @if(request('per_page') == '200') selected @endif>200</option>
                            <option value="500" @if(request('per_page') == '500') selected @endif>500</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="course" class="form-control">
                            <option value=""> --Select Course-- </option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->coursename }}" @if(request('course') == $department->coursename) selected @endif>{{ $department->coursename }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <select name="usepin" class="form-control">
                            <option value=""> --Select-- </option>
                            <option value="0" @if(request('usepin') == '0') selected @endif>Available</option>
                            <option value="1" @if(request('usepin') == '1') selected @endif>Unavailable</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="form-control btn btn-primary">Filter</button>
                    </div>
                    <div class="col-1">
                        <button type="button" class="form-control btn btn-info no-print" id="printButton" onclick="printTable()"><i class="fa fa-print"></i></button>
                    </div>
                </div>
            </div>
        </form>
       
        <div class="card">
 
            <div class="card-body">
                <table class="table table-bordered" id="print-table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>PIN</th>
                            <th>SERIAL</th>
                            <th>COURSE</th>
                            <th style="text-align:center" class="no-print">STATUS</th>
                            <th style="text-align:center width: 10px" class="no-print">ACTION</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($existingPin as $pin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pin->pin }}</td>
                                <td>{{ $pin->serial }}</td>
                                <td>{{ $pin->course_available }}</td>
                                <td class="no-print" style="text-align:center ">
                                    @if ($pin->admissionnumber >= 1)
                                        been used by (<a href="javascript:;">{{ $pin->admissionnumber }}</a>)
                                    @else
                                        Available
                                    @endif
                                </td>
                                <td class="no-print" style="text-align: center;">

                                    <a href="{{ url('/panel/admin/change/course/delete/' . $pin->courseformID) }}"
                                        class="badge bg-danger" type="submit"
                                        onclick="return confirm('Are you sure you want to delete this pin and serial ?')"><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">

                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        <ul  class="pagination no-print">
                            {{ $existingPin->links() }}

                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

        </div>


    </div>
@endsection

<script>
    function checkNumber() {
        var input = document.getElementById("myNumber");
        if (input.value > 15) {
            input.value = 15;
        }
    }
</script>
<script>
    function printTable() {
        window.print();
    }
</script>

