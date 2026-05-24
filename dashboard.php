<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// counts for dashboard
$products = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$productsCount = mysqli_fetch_assoc($products)['total'];

$deliveries = mysqli_query($conn, "SELECT COUNT(*) as total FROM deliveries");
$deliveriesCount = mysqli_fetch_assoc($deliveries)['total'];

$pending = mysqli_query($conn, "SELECT COUNT(*) as total FROM deliveries WHERE DelStatus='Pending'");
$pendingCount = mysqli_fetch_assoc($pending)['total'];

$delivered = mysqli_query($conn, "SELECT COUNT(*) as total FROM deliveries WHERE DelStatus='Delivered'");
$deliveredCount = mysqli_fetch_assoc($delivered)['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body{
            margin:0;
            font-family:Arial, sans-serif;
            display:flex;
            background:#ffe6f1;
        }

        .sidebar{
            width:220px;
            height:100vh;
            background:#ff4fa3;
            color:white;
            padding:20px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:10px;
            margin-bottom:10px;
            border-radius:8px;
            background:rgba(255,255,255,0.2);
        }

        .sidebar a:hover{
            background:white;
            color:#ff4fa3;
        }

        .main{
            flex:1;
            padding:30px;
        }

        h1{
            color:#ff4fa3;
            margin-bottom:20px;
        }

        .cards{
            display:grid;
            grid-template-columns:repeat(4, 1fr);
            gap:20px;
            margin-top:20px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.1);
            text-align:center;
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h2{
            margin:0;
            color:#ff4fa3;
            font-size:18px;
        }

        .card p{
            font-size:28px;
            font-weight:bold;
            margin:10px 0 0;
        }

        /* responsive fix */
        @media(max-width:900px){
            .cards{
                grid-template-columns:repeat(2, 1fr);
            }
        }

        @media(max-width:500px){
            .cards{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h2>🌸 Hermes SIMS</h2>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="deliveries.php">🚚 Deliveries</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h1>

    <div class="cards">

        <div class="card">
            <h2>📦 Products</h2>
            <p><?php echo $productsCount; ?></p>
        </div>

        <div class="card">
            <h2>🚚 Deliveries</h2>
            <p><?php echo $deliveriesCount; ?></p>
        </div>

        <div class="card">
            <h2>⏳ Pending</h2>
            <p><?php echo $pendingCount; ?></p>
        </div>

        <div class="card">
            <h2>✅ Delivered</h2>
            <p><?php echo $deliveredCount; ?></p>
        </div>

    </div>

</div>

</body>
</html>