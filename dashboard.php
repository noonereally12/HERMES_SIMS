<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$products = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products");
$prodCount = mysqli_fetch_assoc($products)['total'];

$deliveries = mysqli_query($conn, "SELECT COUNT(*) AS total FROM deliveries");
$delCount = mysqli_fetch_assoc($deliveries)['total'];

$pending = mysqli_query($conn, "SELECT COUNT(*) AS total FROM deliveries WHERE DelStatus='Pending'");
$pendingCount = mysqli_fetch_assoc($pending)['total'];

$delivered = mysqli_query($conn, "SELECT COUNT(*) AS total FROM deliveries WHERE DelStatus='Delivered'");
$deliveredCount = mysqli_fetch_assoc($delivered)['total'];

$lowstock = mysqli_query($conn, "SELECT COUNT(*) AS total FROM products WHERE ProdStock < 10");
$lowStockCount = mysqli_fetch_assoc($lowstock)['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body{
    font-family:Arial;
    margin:0;
    display:flex;
    background:linear-gradient(135deg,#ffe6f1,#ffd1e8);
}

.sidebar{
    width:240px;
    height:100vh;
    background:linear-gradient(180deg,#ff4fa3,#ff2f92);
    color:white;
    padding:20px;
}

.sidebar h2{
    text-align:center;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:8px 0;
    border-radius:10px;
    background:rgba(255,255,255,0.15);
}

.sidebar a:hover{
    background:white;
    color:#ff4fa3;
}

.main{
    flex:1;
    padding:30px;
}

h1,h2{
    color:#ff2f92;
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 10px 20px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    color:#ff4fa3;
}

.number{
    font-size:28px;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="sidebar">
    <h2>Hermes SIMS</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="products.php">Products</a>
    <a href="deliveries.php">Deliveries</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

<h1>Welcome <?php echo $_SESSION['username']; ?> 💖</h1>

<div class="cards">

<div class="card">
<h3>Products</h3>
<div class="number"><?php echo $prodCount; ?></div>
</div>

<div class="card">
<h3>Deliveries</h3>
<div class="number"><?php echo $delCount; ?></div>
</div>

<div class="card">
<h3>Pending</h3>
<div class="number"><?php echo $pendingCount; ?></div>
</div>

<div class="card">
<h3>Delivered</h3>
<div class="number"><?php echo $deliveredCount; ?></div>
</div>

<div class="card">
<h3>Low Stock</h3>
<div class="number"><?php echo $lowStockCount; ?></div>
</div>

</div>

</div>

</body>
</html>