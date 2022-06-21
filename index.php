<!doctype html>
<html lang="cs">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Oscar</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container p-5">
	<h1 class="text-center">Nahrajte CSV soubory s výherci Oscarů</h1>
	<form method="post" action="results.php" enctype="multipart/form-data">
		<div class="form-group">
			<label for="female_oscars">Ženy</label>
			<input type="file" class="form-control" name="female_oscars" id="female_oscars" required>
		</div>
		<div class="form-group">
			<label for="male_oscars">Muži</label>
			<input type="file" class="form-control" name="male_oscars" id="male_oscars" required>
		</div>
		<input type="submit" class="btn btn-primary mt-3" value="Zobrazit tabulky"/>
	</form>
</div>
</body>
</html>