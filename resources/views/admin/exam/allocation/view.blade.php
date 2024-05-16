@extends('admin.layout.app')

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Filter form -->
    <form class=" no-print" action="{{ route('view_allocate') }}" method="GET">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: 700;">APPLICANT ALLOCATION VIEW</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="session">Session</label>
                            <select name="session" id="session" class="form-control">
                                <option value="">All Sessions</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                                <option value="2033">2033</option>
                                <option value="2034">2034</option>
                                <option value="2035">2035</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                    <div class="form-group">
                        <label for="batch">Batch</label>
                       <select name="batch" id="batch" class="form-control">
                    <option value="">All Batches</option>
                </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="time">Time</label>
                       <select name="time" id="time" class="form-control">
                    <option value="?">All Times</option>
                </select>
                    </div>
                </div>
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="per_page">Results per Page</label>
                            <select name="per_page" id="per_page" class="form-control">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="per_page">filter</label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="per_page">Export</label>
                        <div class="form-group">
                            <a href="{{ route('export_candidates_list', request()->all()) }}"  class="btn btn-info">Export</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </form>
 
    <!-- Applicant Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="font-weight:700;"><div id="selectedValuesDisplay">
   <span>You selected Session: <strong>{{ $sessionselected }}</strong>, Batch: <strong>{{ $batchselected }}</strong>, and Time: <strong>{{ $timeselected }}</strong>.</span>

</div></h3>

            <button style="float: right;" class="btn btn-info" id="printButton">Print Table</button>

        </div>

        <div class="card-body">
            <table id="printContainer" class="table table-bordered" style="font-size: 12px;">
                <!-- Table headings -->
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>FULLNAME</th>
                        <th>PASSPORT</th>
                        <th>BATCH - TIME</th>
                         <th>ADMIN. NO</th>
                        <th>GENDER</th>
                        <th>SIGNATURE</th>
                     </tr>
                </thead>
                <tbody>
                     @foreach ($candidate as $cand)
                       <tr>
                         <td>{{  $loop->iteration}} 
                         <td style="width:15em">{{ $cand->candidateInfo->surname }}
                         {{ $cand->candidateInfo->firstname }}
                         {{ $cand->candidateInfo->othername }}</td>
                            <td style="width:10em">
                                @if ($cand->candidateInfo->passport)
                                    <img style="width:10em; height:10em;" src="{{ asset('storage/' . ltrim($cand->candidateInfo->passport, '.')) }}" alt="passport">


                                @else
                                    {{--  <!-- Show a default image if no image is available -->
                                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="Default Image" style="max-width: 100%;">  --}}
                                @endif
                            </td>    
                          <td>{{ $cand->batch->name }} - {{ $cand->time }}</td>
                          <td>{{ $cand->admissionnumber }}</td>
                         <td>{{ $cand->candidateInfo->gender }}</td>
                         <td>{{ $cand->candidateInfo->phone }}</td>
                         <td> </td>
                     </tr>
                 @endforeach
                  
                  </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="row no-print">
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging

_simple_numbers" id="example2_paginate">
                                        {{ $candidate->appends(request()->except('page'))->links() }}

                 </div>
            </div>
        </div>
    </div>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        // Load selected values from localStorage on page load
        var storedSession = localStorage.getItem("selectedSession");
        var storedBatch = localStorage.getItem("selectedBatch");
        var storedTime = localStorage.getItem("selectedTime");

        if (storedSession) {
            $('#session').val(storedSession);
            updateBatchAndTimeDropdowns(storedSession, storedBatch, storedTime);
        }

        // Handle change events for session, batch, and time dropdowns
        $('#session, #batch, #time').on('change', function () {
            var selectedSession = $('#session').val();
            var selectedBatch = $('#batch').val();
            var selectedTime = $('#time').val();

            updateBatchAndTimeDropdowns(selectedSession, selectedBatch, selectedTime);
        });

        function updateBatchAndTimeDropdowns(session, batch, time) {
            if (session) {
                $.ajax({
                    url: "{{ route('get_batches_and_times') }}",
                    type: "GET",
                    data: {
                        session: session
                    },
                    dataType: "json",
                    success: function (response) {
                        // Update Batch select options
                        var batchSelect = $('#batch');
                        batchSelect.empty();
                        batchSelect.append($('<option>').text('All Batches'));

                        // Iterate through batches and batch names arrays
                        for (var i = 0; i < response.batches.length; i++) {
                            var batchValue = response.batches[i];
                            var batchName = response.batchNames[i];
                            batchSelect.append($('<option>').text(batchName).attr('value', batchValue));
                        }

                        // Select the previously selected batch, if available
                        if (batch) {
                            batchSelect.val(batch);
                        }

                        // Update Time select options
                        var timeSelect = $('#time');
                        timeSelect.empty();
                        timeSelect.append($('<option>').text('All Times'));
                        $.each(response.times, function (index, value) {
                            timeSelect.append($('<option>').text(value).attr('value', value));
                        });

                        // Select the previously selected time, if available
                        if (time) {
                            timeSelect.val(time);
                        }
                    }
                });
            } else {
                $('#batch').empty();
                $('#time').empty();
            }
            
            // Store selected values in localStorage
            localStorage.setItem("selectedSession", session);
            localStorage.setItem("selectedBatch", batch);
            localStorage.setItem("selectedTime", time);
        }
    });
</script>
  <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();

        });
    </script>

@endsection
