<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SAmple</title>
</head>
<body>
	
		<form action="import" method="post" enctype="multipart/form-data">
		<label>Upload a file</label>
		<input type="file" name="file"/><br>
		<input type="hidden" value="{{csrf_token()}}" name="_token">
		<input type="submit" value="upload">
			
		</form>

</body>
</html>
