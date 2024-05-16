@extends('admin.layout.app')
@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
@endsection
@section('content')
    <div class="row">
 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">FILTER ONLINE CANDIDATE PIN</h3>
                </div>
                <form action="{{ route('add_pin') }}" method="GET">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <select name="per_page" class="form-control">
                                    <option value="20" @if (request('per_page') == '20') selected @endif>20</option>
                                    <option value="50" @if (request('per_page') == '50') selected @endif>50</option>
                                    <option value="100" @if (request('per_page') == '100') selected @endif>100</option>
                                    <option value="200" @if (request('per_page') == '200') selected @endif>200</option>
                                    <option value="500" @if (request('per_page') == '500') selected @endif>500</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="usepin" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="0" @if (request('usepin') == '0') selected @endif>Available
                                    </option>
                                    <option value="1" @if (request('usepin') == '1') selected @endif>Unavailable
                                    </option>
                                </select>
                            </div>
                            <div class="col-3">
                                <input name="serch" placeholder="search....." class="form-control">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                            <div class="col-1">
                                <a target="_blank"
                                    href="{{ route('candidate.pin.print', ['per_page' => request('per_page', 20), 'usepin' => request('usepin', 0)]) }}"
                                    class="btn btn-info" style="float: right;"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        <th style="text-align:center">Email</th>
                        <th style="text-align:center">Expiry</th>
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
                            <td style="text-align:center">
                                @php
                                    $customeremail = DB::table('customers')
                                        ->where('id', $pin->customer_id)
                                        ->pluck('email')
                                        ->first();
                                    $pinexpire = DB::table('site_configs')
                                        ->where('code', 1)
                                        ->pluck('pin_expiry_date')
                                        ->first();
                                @endphp
                                {{ $customeremail ?? 'Email Not Found' }}
                            </td>
                            <td style="text-align:center">

                                @if ($pin->admissionnumber >= 1)
                                    been used by (<a href="javascript:;">{{ $pin->admissionnumber }}</a>)
                                @else
                                    Available
                                @endif
                            </td>
                            <td class="no-print" style="text-align: center;">
                                <a href="{{ url('/panel/admin/candidate/pin/delete/' . $pin->id) }}" class="badge bg-danger"
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this pin and serial ?')"><i
                                        class="fa fa-trash"></i></a>
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
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('candidate.register.config') }}")
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const expiryDate = new Date(data.configure.pin_expiry_date);
                    const options = {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    };
                    const formattedDate = expiryDate.toLocaleDateString('en-GB', options);
                    document.getElementById('expiredate').innerText = formattedDate;

                    const pinPrice = parseFloat(data.configure.pin_price);
                    const formattedPrice = 'NGN ' + pinPrice.toLocaleString('en-NG', {
                        maximumFractionDigits: 0
                    });
                    document.getElementById('pin_price').innerText = formattedPrice;

                    const pin_expiry_price = parseFloat(data.configure.pin_expiry_price);
                    const formattedpin_expiryPrice = 'NGN ' + pin_expiry_price.toLocaleString('en-NG', {
                        maximumFractionDigits: 0
                    });
                    document.getElementById('pin_expiry_price').innerText = formattedpin_expiryPrice;
                    const formStatus = parseInt(data.configure.form_status);
                    if (formStatus === 1) {
                        document.getElementById('form_status').innerText = 'OPEN';
                    } else {
                        document.getElementById('form_status').classList.add('text-danger');
                        document.getElementById('form_status').innerText = 'CLOSED';
                    }

                } else {
                    document.getElementById('expiredate').innerText = '0';
                    document.getElementById('pin_price').innerText = 'NGN 0';
                    document.getElementById('pin_expiry_price').innerText = 'NGN 0';
                    document.getElementById('form_status').innerText = 'UNKNOWN';

                }
            })
            .catch(error => console.error('Error fetching dashboard data:', error));
    });
</script>
