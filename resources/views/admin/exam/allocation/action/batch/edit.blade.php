@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h4 style="font-weight: 700;">BATCH UPDATE</h4>
                </div>
                <div class="col-sm-8">
                    <h4 style="font-weight: 700;"><i>Null</i></h4>
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
                        <form action="{{ route('exam_allocate') }}" method="GET">
                            <div class="card-body">
                                @php
                                    $allocated = DB::table('batches')
                                        ->where('session', $bat->session)
                                        ->sum('allocation');
                                    $remaining = $candidate - $allocated;
                                @endphp

                                @php
                                    $allocation = DB::table('batches')
                                        ->where('id', $bat->id)
                                        ->pluck('allocation')
                                        ->first();
                                    $totalCandidates = $allocation + $remaining;
                                @endphp
                                <p>Total candidate left in the batch: {{ $totalCandidates }}</p>
                                <div class="form-group">
                                    <select id="mySelect" onchange="updateInput()" name="session"vh
                                        class="form-control select2" style="width: 100%;">
                                        <option value="{{ $bat->session }}">{{ $bat->session }}</option>

                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>



                    <form action="{{ url('allocation/batch/update/' . $bat->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">{{ $bat->name }}</h3>
                            </div>
                            <input style="display: none" name="session2" type="text" value="{{ $totalCandidates }}">
                            <input style="display: none" name="session" type="text" id="myInput">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="name" required type="test" class="form-control"
                                                placeholder="{{ $bat->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input name="allocation" required type="number" class="form-control"
                                                placeholder="{{ $bat->allocation }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="description" required value="{{ $bat->description }}" type="date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary col-md-4">Save</a
                                        class="col-md-2"><i></i></button>
                                <a href="{{ route('exam_allocate') }}" style="float: right;"
                                    class="btn btn-warning col-md-4">Cancel</a>
                            </div>
                        </div>
                    </form>


                </div>
                <div class="col-md-8">

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title" style="font-weight: 400;"> null</h3>
                        </div>
                        <div class="card-body">
                            <form>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><i>null</i></label>
                                            <input disabled name="time_range" required type="text" class="form-control"
                                                placeholder="null">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label><i>null</i></label>
                                            <input disabled name="allocation_to" class="form-control" placeholder="null">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary col-md-12"><i>null</i></button>

                                    </div>
                                </div>
                                <p>Allocation Remaining: null</p>
                            </form>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Time range</th>
                                        <th>Allocation from</th>
                                        <th>Allocation to</th>
                                        <th>Total students</th>
                                        <th colspan="2" style="text-align: center;">Action</th>

                                    </tr>
                                </thead>

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
