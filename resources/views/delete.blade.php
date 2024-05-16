 <h1>Duplicate Data Check</h1>

    @if (count($duplicates) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Admission Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($duplicates as $duplicate)
                    <tr>
                        <td>{{ $duplicate->admissionnumber }}</td>
                        <td>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No duplicate data found.</p>
    @endif