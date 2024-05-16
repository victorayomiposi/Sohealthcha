<!DOCTYPE html>
<html>
<head>
    <title>Department Blogs</title>
</head>
<body>
    <h1>Department Blogs</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>About</th>
                <th>Description</th>
                <th>Contents</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deptblogs as $deptblog)
                <tr>
                    <td>{{ $deptblog->name }}</td>
                    <td>{{ $deptblog->about }}</td>
                    <td>{{ $deptblog->description }}</td>
                    <td>
                        @foreach($deptblog->deptcontent as $deptcontent)
                            <p>Title: {{ $deptcontent->title }}</p>
                            <p>Description: {{ $deptcontent->description }}</p>
                            <p>Date: {{ $deptcontent->date }}</p>
                            <hr>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
