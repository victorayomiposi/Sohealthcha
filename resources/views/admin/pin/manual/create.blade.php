@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
@endsection
@section('content')
    <div class="card card-danger">
        <div class="card-header no-print">
            <h3 class="card-title">GENERATE PIN</h3>
        </div>
        <form action="{{ route('pins.store') }}" method="POST">
            @csrf
            <div class="card-body no-print">
                <div class="row">
                    <div class="col-3">
                        <select name="amount" class="form-control">
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <input name="length" type="number" id="myNumber" oninput="checkNumber()" min="1" max="15" class="form-control">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="form-control btn btn-warning">Generate</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-header bg-secondary no-print">
            <h3 class="card-title">FILTER CANDIDATE PIN</h3>
        </div>
        <form class="no-print" action="{{ route('add_pin') }}" method="GET">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <select name="per_page" class="form-control">
                            <option value="20" @if(request('per_page') == '20') selected @endif>20</option>
                            <option value="50" @if(request('per_page') == '50') selected @endif>50</option>
                            <option value="100" @if(request('per_page') == '100') selected @endif>100</option>
                            <option value="200" @if(request('per_page') == '200') selected @endif>200</option>
                            <option value="500" @if(request('per_page') == '500') selected @endif>500</option>
                            <option value="1000" @if(request('per_page') == '1000') selected @endif>500</option>
                        </select>
                    </div>

                    <div class="col-4">
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
                     <a target="_blank" style="float: right" href="{{ route('candidate.pin.print', ['per_page' => request('per_page', 20), 'usepin' => request('usepin', 0)]) }}" class="form-control btn btn-info"><i class="fa fa-print"></i></a>
                <!--<button style="float: right" type="button" class="form-control btn btn-info no-print" id="printButton" onclick="printTable()"><i class="fa fa-print"></i></button>-->
                    </div>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Candidate Pin Table</h3>
            </div>
            <div class="card-body">
                <table id="pindata" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>PIN</th>
                            <th>SERIAL</th>
                            <th style="text-align:center">STATUS</th>
                            <th style="text-align:center width: 10px">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($existingPin as $pin)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pin->pinnumber }}</td>
                                <td>{{ $pin->serialnumber }}</td>
                                <td style="text-align:center">
                                    @if ($pin->admissionnumber >= 1)
                                        been used by (<a href="javascript:;">{{ $pin->admissionnumber }}</a>)
                                    @else
                                        Available
                                    @endif
                                </td>
                                <td class="no-print" style="text-align: center;">
                                    <a href="{{ url('/panel/admin/candidate/pin/delete/' . $pin->id) }}" class="badge bg-danger" type="submit" onclick="return confirm('Are you sure you want to delete this pin and serial ?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row no-print">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        <ul class="pagination">
                            {{ $existingPin->appends(request()->query())->links() }}
                        </ul>
                    </div>
                </div>
            </div>
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

    function printTable() {
        // Get the table rows
        var tableRows = document.querySelectorAll('#pindata tbody tr');
        var pdfData = {
            content: [{
                table: {
                    headerRows: 1,
                    widths: ['10%', '45%', '45%'],
                     body: [
                        [{
                                text: 'S/N',
                                style: 'tableHeader'
                            },
                             {
                                text: 'Pin',
                                style: 'tableHeader'
                            },
                            {
                                text: 'Serial',
                                style: 'tableHeader'
                            }

                        ]
                    ]
                }
            }],
            
            styles: {
    tableHeader: {
        bold: true,
        fillColor: '#007BFF',
        color: '#ffffff',
      },
    tableBody: {
        fillColor: ['#f2f2f2', '#ffffff'],
        bold: true,  
        heights: [15, 15, 15, 15],  
        border: [true, true, true, true], 
    }
}

        };
        

        // Populate the table rows dynamically
        tableRows.forEach(function(row) {
            var sn = row.querySelectorAll('td')[0].textContent.trim();
            var pin = row.querySelectorAll('td')[1].textContent.trim();
            var serial = row.querySelectorAll('td')[2].textContent.trim();
            pdfData.content[0].table.body.push([sn, pin, serial]);
        });

        pdfMake.createPdf(pdfData).download('CandidatePins.pdf');
    }
</script>
