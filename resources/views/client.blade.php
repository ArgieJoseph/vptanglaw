
<!DOCTYPE html>
<html>
<head>
	<title>SAMPLE</title>
</head>
<body>
<h1>List</h1>
<table>
	<tr>
		<th>campus</th>
		<th>category</th>
		<th>program</th>
		<th>status</th>
		<td>action</td>
	</tr>
	@foreach($clients as $c)
<tr>
		<td>{{$c->campus}}</td>
		<td>{{$c->category}}</td>
		<td>{{$c->program}}</td>
		<td>{{$c->status}}</td>
		<td>{{$c->action}}</td>
	</tr>
	@endforeach

</table>

</body>
</html>