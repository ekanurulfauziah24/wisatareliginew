<?php
include 'header.php';
include 'sidebar.php';
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisatareligieka"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_count = "SELECT COUNT(*) AS total_produk FROM produk_wisata";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_produk = $row_count['total_produk'];
?>

<div class="main-content">
    <?php
    
    if (isset($_SESSION['notif'])) {
        echo "<div class='notif'>" . $_SESSION['notif'] . "</div>";
        unset($_SESSION['notif']); 
    }
    ?>

<div class="dashboard-content">
    <h3 class="welcome-text">Selamat datang di Wisata Religi yang ada di Indonesia</h3>
</div>

<style>
    
    .welcome-text {
        font-family: 'Times New Roman', serif;
        font-size: 24px;
        color:hsl(180, 2.60%, 7.60%); 
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    
    .dashboard-content {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 50px;
        padding: 40px;
    }
</style>

        <div class="stats">
    <div class="stat-card">
        
        <i class="fas fa-map-marked-alt"></i>
        <h4>Total Produk Wisata</h4>
        <p><?php echo $total_produk; ?></p> 
    </div>
</div>

<style>
    .stats {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .stat-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 30px;
        text-align: center;
        width: 250px;
        margin: 0 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .stat-card i {
        font-size: 40px;
        color: #007BFF; 
        margin-bottom: 15px;
    }

    .stat-card h4 {
        font-size: 22px;
        color: #333;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .stat-card p {
        font-size: 28px;
        color: #007BFF; 
        font-weight: 700;
    }
</style>


        
<div class="chart-container">
    <h4 class="centered-text">Grafik Produk Wisata per Bulan</h4>
    <canvas id="produkWisataChart" width="400" height="200"></canvas>
</div>

<style>
    
    .centered-text {
        font-family: 'Times New Roman', serif; 
        font-size: 24px;
        color: #333; 
        text-align: center; 
        margin-bottom: 20px; 
    }

    
    .chart-container {
        text-align: center; 
        padding: 20px;
    }
</style>

<?php include 'footer.php'; ?>

<
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

var ctx = document.getElementById('produkWisataChart').getContext('2d');
var produkWisataChart = new Chart(ctx, {
    type: 'line', 
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], 
        datasets: [{
            label: 'Produk Wisata per bulan', 
            data: [5, 10, 15, 20, 25, 30], 
            borderColor: 'rgb(75, 192, 192)', 
            fill: false, 
            tension: 0.1 
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.raw + ' produk'; 
                    }
                }
            }
        }
    }
});
</script>
