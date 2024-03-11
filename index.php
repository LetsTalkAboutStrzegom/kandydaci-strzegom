<?php 
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Lets Talk About Strzegom">
		<title>Wybory 7 kwietnia | Strzegom</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">  
		<style>
			.tab-header {
				background: yellow;
			}		
			body {
				margin-top: 1rem !important;
				margin-bottom: 1rem !important;
			}			
			.icon-check {
				font-weight:bold; 
				color:green;
			}
			.icon-cancel {
				font-weight:bold; 
				color:red;
			}
			.left-align {
				text-align: left;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h4>Kandydaci na Burmistrza Strzegomia</h4>
			<hr/>
			<table class="table table-striped">
				<thead>
					<tr>	
						<th style="background: yellow;">Komitety</th>
						<th style="background: yellow;">Nazwisko i imiona</th>
						<th style="background: yellow;">Miejscowość</th>
						<th style="background: yellow;">Wiek</th>
						<th style="background: yellow;">Zarejestrowany</th>
					</tr>							
				</thead>
				<tbody>
					<tr>
						<td>KWW ZBIGNIEW SUCHYTA</td>
						<td>Zbigniew Suchyta</td>
						<td>Strzegom</td>
						<td>66</td>
						<td><span class="icon-check">&#10003;</span></td>
					</tr>
					<tr>
						<td>KWW LECHA MARKIEWICZA</td>
						<td>Lech Markiewicz</td>
						<td>Strzegom</td>
						<td>69</td>
						<td><span class="icon-check">&#10003;</span></td>
					</tr>
					<tr>
						<td>KWW WWITKOWSKI</td>
						<td>Wiesław Witkowski</td>
						<td>Strzegom</td>
						<td>50</td>
						<td><span class="icon-cancel">&#10005;</span></td>
					</tr>
					<tr>
						<td>KWW KRZYSZTOF KALINOWSKI</td>
						<td>Krzysztof Kalinowski</td>
						<td>Strzegom</td>
						<td>50</td>
						<td><span class="icon-check">&#10003;</span></td>
					</tr>
				</tbody>
			</table>
			<h4>Kandydaci do Rady Miejskiej w Strzegomiu</h4>
			<hr/>
			<div class="row" style="align-items:center;">
				<div class="col-md-12">
					<p style="font-weight:bold;">Filtruj:</p>
				</div>
				<div class="col-md-3">
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="okreg1" name="okreg" value="1">
						<label class="form-check-label" for="okreg1">Okręg 1</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="okreg2" name="okreg" value="2">
						<label class="form-check-label" for="okreg2">Okręg 2</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="checkbox" id="okreg3" name="okreg" value="3">
						<label class="form-check-label" for="okreg3">Okręg 3</label>
					</div>
				</div>
				<div class="col-md-3">
					<select class="form-select" id="table-filter">
						<option value="" selected>Wybierz komitet</option>
						<option value="KWW ZBIGNIEW SUCHYTA">KWW ZBIGNIEW SUCHYTA</option>
						<option value="KWW LECHA MARKIEWICZA">KWW LECHA MARKIEWICZA</option>
						<option value="KWW WWITKOWSKI">KWW WWITKOWSKI</option>
						<option value="KWW KRZYSZTOF KALINOWSKI">KWW KRZYSZTOF KALINOWSKI</option>
					</select>
				</div>
			</div>
			<table id="data" class="table table-striped">
				<thead class="tab-header">
					<tr>
						<th>Komitety</th>
						<th>Okręg</th>
						<th>Nr na liście</th>
						<th>Nazwisko i imiona</th>
						<th>Miejscowość</th>
						<th>Wiek</th>
					</tr>
				</thead>
				<?php
					$filename = 'data.csv';
					$file = fopen($filename, 'r');

					if ($file !== FALSE) {
						echo "<tbody class='left-align'>";
						while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
							echo "<tr>";
							foreach ($row as $cell) {
								echo "<td>" . htmlspecialchars($cell) . "</td>";
							}
							echo "</tr>";
						}
						echo "</tbody>";
						fclose($file);
					} else {
						echo "Błąd otwarcia pliku.";
					}
				?>
			</table>
		</div>
		<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
		<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>				
		<script>
			$(document).ready( function () {
				var table = $('#data').DataTable({
					"language": {
						"url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json" 
					},
					"pageLength": 50
				});
				$('input:checkbox').on('change', function () {
					var okreg = $('input:checkbox[name="okreg"]:checked').map(function() {
						return '^' + this.value + '$';
					}).get().join('|');
					table.column(1).search(okreg, true, false, false).draw(false);
				});
				$('#table-filter').on('change', function(){
					table.search(this.value).draw();   
				});	
			});
		</script>
	</body>
</html>
