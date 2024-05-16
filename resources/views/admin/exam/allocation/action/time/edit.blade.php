@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h4 style="font-weight: 700;">BATCH CREATE</h4>
                </div>
                <div class="col-sm-8">
                    <h4 style="font-weight: 700;">TIME ALLOCATION UPDATE</h4>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Select Session</h3>
                        </div>
                             <div class="card-body">
                               
                                <div class="form-group">
                                    <select id="mySelect" onchange="updateInput()" name="session"vh
                                        class="form-control select2" style="width: 100%;">
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success col-md-12">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Create Batch</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input required name="name" type="text" class="form-control"
                                                placeholder="Batch Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input required name="allocation" type="number" class="form-control"
                                                placeholder="Allocation">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input required name="description" type="date" class="form-control">
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success col-md-12">Create</button>
                            </div>
                        </form>
                    </div>
                         <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input disabled type="test" class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input disabled type="number" class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input value="" disabled type="date" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a
                                    class="btn btn-warning col-md-4"><i class="fa fa-edit"></i></a
                                    class="col-md-2"><i></i>
                                <a style="float: right;"
                                    class="btn btn-danger col-md-4"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
 
                </div>
                <div class="col-md-8">
                         <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title" style="font-weight: 400;">{{ $bat->name }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.time') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Time Range</label>
                                                <input required name="time_range" type="text" class="form-control"
                                                    placeholder="8am to 9am">
                                            </div>
                                        </div>
                                        <input style="display: none" name="batch_id" value="{{ $bat->id }}"
                                            type="text">
                                        <input style="display: none" name="sesion" value="{{ $bat->session }}"
                                            type="text">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Student Range</label>
                                                <input required name="allocation_to" type="number" class="form-control"
                                                    placeholder="Enter student range  ...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary col-md-12">Create</button>

                                        </div>
                                    </div>
                                    @php
                                        $allocated = DB::table('times')
                                        ->where('batch_id', $bat->id)
                                        ->sum('allocation_to');
                                        $remainingAllocation = $bat->allocation - $allocated;
                                    @endphp

                                    <input style="display: none;" name="allocation_limit"
                                        value="{{ $remainingAllocation }}" type="text">
                                    <p>Allocation Remaining: {{ $remainingAllocation }}</p>
                                </form>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Time range</th>
                                            <th>Total students</th>
                                            <th colspan="2" style="text-align: center;">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                             <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><b>{{ $time->time_range }}</b></td>
                                                <td><b>{{ $time->allocation_to }}</b> student</td>
                                                <td>
                                                    <a onclick="return confirm('Are you sure you want to edit')"
                                                       href="{{ url('panel/allocation/time/edit/' . $time->id) }}"
                                                       class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <a onclick="return confirm('Are you sure you want to delete')"
                                                       href="{{ url('panel/allocation/time/delete/' . $time->id) }}"
                                                       class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                     </tbody>
                                </table>
                            </div>
                        </div>
                 </div>
            </div>
        </div>
    </section>

    <script>
        // Retrieve the last selected option from localStorage, if available
        var lastOption = localStorage.getItem("lastOption");
        if (lastOption) {
            document.getElementById("mySelect").value = lastOption;
            document.getElementById("myInput").value = lastOption;
        }

        function updateInput() {
            var selectValue = document.getElementById("mySelect").value;
            document.getElementById("myInput").value = selectValue;

            // Store the selected option in localStorage
            localStorage.setItem("lastOption", selectValue);
        }
    </script>
@endsection
