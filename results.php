<!doctype html>
<html lang="cs">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Oscar - tabulky</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<div class="container p-5">
		<?php

		function read_uploaded_csv(string $filename): array
		{
			$lines = file($filename,FILE_IGNORE_NEW_LINES);
			unset($lines[0]); //removes header row
			array_pop($lines); //removes last empty row

			return $lines;
		}

		$female_oscar_movies_lines = read_uploaded_csv($_FILES['female_oscars']['tmp_name']);
		$male_oscar_movies_lines = read_uploaded_csv($_FILES['male_oscars']['tmp_name']);

		?>

		<h1>Výsledky</h1>
		<h2>Tabulka s přehledem oscarů podle roku</h2>
		<table class="table">
			<tr>
				<th>Rok</th>
				<th>Ženy</th>
				<th>Muži</th>
			</tr>

			<?php
			const CSV_SEPARATOR = ', ';
			$oscar_movies_lines = [];
			foreach ($female_oscar_movies_lines as $female_oscar_line) {
				$female_oscar_line = str_getcsv($female_oscar_line, CSV_SEPARATOR);

				list($female_index, $female_oscar_year, $actress_age, $actress, $female_oscar_movie_name) = $female_oscar_line;
				$actress_age = (int)$actress_age;
				$female_oscar_year = (int)$female_oscar_year;

				$oscar_movies_lines[$female_oscar_year]['actress'] = $actress;
				$oscar_movies_lines[$female_oscar_year]['actress_age'] = $actress_age;
				$oscar_movies_lines[$female_oscar_year]['female_oscar_movie_name'] = $female_oscar_movie_name;
			}

			foreach ($male_oscar_movies_lines as $male_oscars_line){
				$male_oscar_line = str_getcsv($male_oscars_line, CSV_SEPARATOR);

				list($male_index, $male_oscar_year, $actor_age, $actor, $male_oscar_movie_name) = $male_oscar_line;
				$actor_age = (int)$actor_age;
				$male_oscar_year = (int)$male_oscar_year;

				$oscar_movies_lines[$male_oscar_year]['actor'] = $actor;
				$oscar_movies_lines[$male_oscar_year]['actor_age'] = $actor_age;
				$oscar_movies_lines[$male_oscar_year]['male_oscar_movie_name'] = $male_oscar_movie_name;
			}

			foreach ($oscar_movies_lines as $year => $line){
			?>

			<tr>
				<td class="text"><?php echo $year?></td>
				<td><?php echo "{$line['actress']} ({$line['actress_age']}) <br> {$line['female_oscar_movie_name']}"?></td>
				<td><?php echo "{$line['actor']} ({$line['actor_age']}) <br> {$line['male_oscar_movie_name']}"?></td>
			</tr>

			<?php
			}
			?>
		</table>

		<?php
		uasort($oscar_movies_lines, function ($a, $b) {
			return $a['female_oscar_movie_name'] <=> $b['female_oscar_movie_name'];
		});
		?>

		<h2>Tabulka se seznamem filmů, které obdržely oscary za mužskou i ženskou hlavní roli</h2>
		<table class="table">
			<tr>
				<th>Název filmu</th>
				<th>Rok</th>
				<th>Herečka</th>
				<th>Herec</th>
			</tr>

			<?php
				foreach ($oscar_movies_lines as $year => $movie) {
					if ($movie['female_oscar_movie_name'] === $movie['male_oscar_movie_name']){
						?>
						<tr>
							<td><?php echo $movie['female_oscar_movie_name']?></td>
							<td><?php echo $year?></td>
							<td><?php echo $movie['actress']?></td>
							<td><?php echo $movie['actor']?></td>
						</tr>
						<?php
					}
				}
			?>
			<tr>
		</table>
	</div>
</body>
</html>