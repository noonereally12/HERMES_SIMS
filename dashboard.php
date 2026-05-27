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

$lowStockQuery = mysqli_query($conn, "SELECT * FROM products WHERE ProdStock <= 25");

$expQuery = mysqli_query($conn, "SELECT * FROM products WHERE ProdExp < DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND ProdExp > CURDATE()");
$expiredQuery = mysqli_query($conn, "SELECT * FROM products WHERE ProdExp <= CURDATE()");
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

        .top-right{
            position:absolute;
            top:15px;
            right:20px;
        }

        .role{
            color:#cc538d;
            font-weight:bold;
        }

        .alert{
            padding:12px;
            margin:10px 0;
            border-radius:8px;
            font-weight:bold;
        }

        .low-stock{
            background:#fff3cd;
            color:#856404;
        }

        .expiry{
            background:#f8d7da;
            color:#721c24;
        }

        .expired{
            background:#cca0a5;
            color:#771821;
        }

        .logo-title{

            display:flex;

            align-items:center;

            gap:10px;
        }

        .logo{

            width:40px;
            height:40px;

            border-radius:50%;

            object-fit:cover;
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

    <h2 class="logo-title">
        <img src="images/HERMES.png" class="logo">
        Hermes SIMS
    </h2>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="deliveries.php">🚚 Deliveries</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋 </h1>
    
    <div class="top-right">
    Logged in as:
    <span class="role">
        <?php echo $_SESSION['role']; ?>
    </span>
    </div>

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
        
        <?php while($low = mysqli_fetch_assoc($lowStockQuery)) { ?>
            <div class="alert low-stock">
                ⚠️ Low Stock:
            <?php echo $low['ProdName']; ?> (<?php echo $low['ProdStock']; ?> left)
            </div>
        <?php } ?>

        <?php while($exp = mysqli_fetch_assoc($expQuery)) { ?>
            <div class="alert expiry">
                ⏰ Near Expiration:
                <?php echo $exp['ProdName']; ?>
                (<?php echo $exp['ProdExp']; ?>)
            </div>
        <?php } ?>

        <?php while($exp = mysqli_fetch_assoc($expiredQuery)) { ?>
            <div class="alert expired">
                ❌ Expired:
                <?php echo $exp['ProdName']; ?>
                (<?php echo $exp['ProdExp']; ?>)
            </div>
        <?php } ?>

    </div>

</div>

</body>
</html>
