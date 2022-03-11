<!DOCTYPE html>
<html>
<title>HTML Tutorial</title>
<body>
<h3>Good morning!</h3>

<p>Here is the list of schools created in the past 24h.</p>
<ul>
    @foreach($schools as $school)
        <li>{{$school->name}}</li>
    @endforeach
</ul>


</body>
</html>


