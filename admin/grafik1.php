<!DOCTYPE html>
<html>
<head>
	<title>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS - www.malasngoding.com</title>
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


	<center>
		<h2>MEMBUAT GRAFIK DARI DATABASE MYSQL DENGAN PHP DAN CHART.JS<br/>- www.malasngoding.com -</h2>
	</center>


	<?php 
	include 'connect.php';
	?>

	<div style="width: 800px;margin: 0px auto;">
		<canvas id="myChart"></canvas>
	</div>

	<br/>
	<br/>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama </th>
				<th>NIP</th>
				<th>JK</th>
				<th>Pendidikan</th>
				<th>Pekerjaan</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 1;
			$data = mysqli_query($connect,"select * from responden");
			while($d=mysqli_fetch_array($data)){
				?>
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['nama']; ?></td>
					<td><?php echo $d['nip']; ?></td>
					<td><?php echo $d['jenis_kelamin']; ?></td>
					<td><?php echo $d['pendidikan']; ?></td>
					<td align="center" bgcolor="pink"><?php echo $d['pekerjaan']; ?></td>
				</tr>
				<?php 
			}
			?>
		</tbody>
	</table>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: ["PNS", "Wiraswasta", "TNI", "Mahasiswa", "Pegawai", "DLL"],
				datasets: [{
					label: '',
					data: [
					<?php 
					$pekerjaan_pns = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='PNS'");
					echo mysqli_num_rows($pekerjaan_pns);
					?>, 
					<?php 
					$pekerjaan_swasta = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='Wiraswasta'");
					echo mysqli_num_rows($pekerjaan_swasta);
					?>,
					<?php 
					$pekerjaan_tni = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='TNI/POLRI'");
					echo mysqli_num_rows($pekerjaan_tni);
					?>,
					<?php 
					$pekerjaan_siswa = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='Mahasiswa'");
					echo mysqli_num_rows($pekerjaan_siswa);
					?>,
					<?php 
					$pekerjaan_pegawai = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='Pegawai'");
					echo mysqli_num_rows($pekerjaan_pegawai);
					?>,
					<?php 
					$pekerjaan_dll = mysqli_query($connect,"select pekerjaan * from responden where pekerjaan='Dan lain-lain'");
					echo mysqli_num_rows($pekerjaan_dll);
					?>,	
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>