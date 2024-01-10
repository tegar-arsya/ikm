<!DOCTYPE html>
<html lang="en">
<?php
    include 'connect.php';
    require 'sideindex.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Pekerjaan Responden</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "ikmlapan");

// Periksa koneksi
if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data dari MySQL
$query = "SELECT pekerjaan, COUNT(*) as jumlah FROM responden GROUP BY pekerjaan";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk label (pekerjaan) dan data jumlah
$labels = [];
$data = [];

// Loop untuk mengambil data dari MySQL
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['pekerjaan'];
    $data[] = $row['jumlah'];
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<!-- Tampilkan grafik menggunakan Chart.js -->
<div style="width: 40%; margin: auto;">
    <canvas id="myChart"></canvas>
</div>

<script>
// Inisialisasi data untuk grafik
var data = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'Sebaran Pekerjaan Responden',
        data: <?php echo json_encode($data); ?>,
        backgroundColor: ['rgba(75, 192, 192, 0.2)','rgba(255, 99, 132, 0.2)','rgba(226, 255, 0, 0.8)','rgba(0, 51, 255, 0.8)','rgba(0, 255, 23, 0.8)'],
        borderColor: ['rgba(75, 192, 192, 1)','rgba(255,99,132,1)','rgba(226, 255, 0, 1)','rgba(0, 51, 255, 1)','rgba(0, 255, 23, 1)'],
        borderWidth: 1
    }]
};

// Konfigurasi opsi grafik
var options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
};

// Membuat grafik menggunakan Chart.js
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: data,
    options: options
});
</script>

</body>
</html>
