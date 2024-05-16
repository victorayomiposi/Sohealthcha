<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
</head>
<body>
    @foreach ($show as $show)
 
    <div>
        {!! $show->description !!}
    </div>
    @endforeach
</body>
</html>av