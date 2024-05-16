@extends('admin.layout.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h4 style="font-weight: 700;">BATCH CREATE</h4>
                </div>
                <div class="col-sm-8">
                    <h4 style="font-weight: 700;">TIME ALLOCATION</h4>
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
                                Total number of candidate:{{ $candidate }}
                                @php
                                    $allocated = DB::table('batches')->where('session', $check)->sum('allocation');
                                    $remainning = $candidate - $allocated;
                                @endphp
                                <p>Total number of candidate left: {{ $remainning }}</p>
                                <div class="form-group">
                                    <select id="mySelect" onchange="updateInput()" name="session"vh
                                        class="form-control select2" style="width: 100%;">
                                        @for ($year = 2015; $year <= 2050; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
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
                        <form action="{{ route('store.allocation') }}" method="POST">
                            @csrf
                            <input style="display: none" name="session2" type="text" value="{{ $remainning }}">
                            <input style="display: none" name="session" type="text" id="myInput">

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
                    @foreach ($batchs as $bat)
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">{{ $bat->name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input disabled type="test" class="form-control"
                                                placeholder="{{ $bat->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input disabled type="number" class="form-control"
                                                placeholder="{{ $bat->allocation }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input value="{{ $bat->description }}" disabled type="date" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('edit.batch', ['id' => $bat->id]) }}"
                                    class="btn btn-warning col-md-4 show_confirm_edit"><i class="fa fa-edit"></i></a
                                    class="col-md-2"><i></i>
                                <a href="{{ route('delete.batch', ['id' => $bat->id]) }}" style="float: right;"
                                    class="btn btn-danger col-md-4 show_confirm_delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-md-8">
                    @foreach ($batchs as $bat)
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
                                        @foreach ($bat->times as $time)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><b>{{ $time->time_range }}</b></td>
                                                <td><b>{{ $time->allocation_to }}</b> student</td>
                                                {{--  <td>
                                                    <a onclick="openEditModal({{ $time->id }})"
                                                        class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                                </td>  --}}
                                                <td>
                                                    <a href="{{ route('delete.time', ['id' => $bat->id]) }}"
                                                        class="btn btn-danger show_confirm_delete"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            @php
                                                $allocating = DB::table('times')
                                                    ->where('id', $time->id)
                                                    ->sum('allocation_to');
                                                $remain = $remainingAllocation + $allocating;
                                            @endphp

                                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                                aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Time</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editForm"
                                                                action="{{ url('allocation/time/update/' . $time->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="remain"
                                                                    value="{{ $remain }}">
                                                                <input type="hidden" name="time_id"
                                                                    value="{{ $time->id }}">

                                                                <p>Total Remaining: {{ $remain }}</p>

                                                                <!-- Include other input fields for editing the time -->
                                                                <div class="form-group">
                                                                    <label for="editTimeRange">Time Range</label>
                                                                    <input placeholder="8am to 9am" type="text"
                                                                        class="form-control" id="editTimeRange"
                                                                        name="time_range" value="{{ $time->time_range }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="editAllocation">Allocation</label>
                                                                    <input placeholder="Enter student range..."
                                                                        type="number" class="form-control"
                                                                        id="editAllocation" name="allocation_to"
                                                                        value="{{ $time->allocation_to }}" required>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                onclick="submitEditForm()">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        function openEditModal(timeId) {
            // Get the time data from the page using timeId
            var timeRange = $("#time-" + timeId + " .time-range").text();
            var allocation = $("#time-" + timeId + " .allocation").text();

            // Populate the form fields in the modal
            $("#editTimeId").val(timeId);
            $("#editTimeRange").val(timeRange);
            $("#editAllocation").val(allocation);

            // Open the edit modal
            $("#editModal").modal("show");
        }

        function submitEditForm() {
            // Submit the form using AJAX or regular form submission
            $("#editForm").submit();
        }
    </script>
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
