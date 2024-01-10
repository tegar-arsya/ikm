<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="chartjs/Chart.js"></script>
</head>
<body>
	<style type="text/css">
	body{
		font-family: roboto;
	}

	table{
		margin: 0px auto;
	}
	</style>

	<?php
	$akses_database = mysqli_connect("localhost", "root", "", "ikmlapan");
	if(!$akses_database){
		die("Database tidak berhasil diakses...<br>");
	}
	else{
		print("Database berhasil diakses....<br>");
	}
	?>

	<?php
	$akses_tabel = mysqli_query($akses_database, "SELECT id_responden, tanggal, nama, nip, umur, jenis_kelamin, pendidikan, pekerjaan, id_kategoriResponden FROM responden");
	if(!$akses_tabel){
		die("Tabel tidak berhasil diakses....<br>");
	}
	else{
		print("Tabel berhasil diakses.....<br>");
	}
	?>

	<?php
	$sumbu_y = 'id_responden';

		$k = -1;

		while($row = mysqli_fetch_array($akses_tabel)){

				$y = $row["id_responden"];
				$pekerjaan = $row["pekerjaan"];

				$k - $k = 1;

				$dataPoints[$k] = array("y"=> $y, "label"=> $pekerjaan);
		}
		
	?>

	<script>
	window.onload = function () {

	var chart = new canvasJS.Chart("chartContainer")({
		theme: "light2",
		animationEnabled: true,
		title: {
			text: "Jumlah Survey berdasarkan Pekerjaan"
		},
		subtitles:[{
			text:"Tahun 2023",
			fontsize: 16
		}],
		data: [{
			type: "pie",
			indexLabelFontsize: 18,
			radius : 80,
			indexLabel:"{label}: {y}",
			click: explodePie,
			dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
		}]
	});
	chart.render();

	function explodepie(e) {
		for(var i = 0; i < e.dataSeries.dataPointslength; i++){
			if(i !== e.dataPointIndex)
			e.dataSeries.dataPoints[i].explode = false;
		}
	}
	}
	</script>

	<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
	<script src="canvasjs.min.js"></script>
	</div>
</body>
</html>