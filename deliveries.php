<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "
    SELECT deliveries.*, products.ProdName 
    FROM deliveries 
    LEFT JOIN products ON deliveries.ProdID = products.ProdID
");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Deliveries</title>

    <style>
.add-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 15px;
    background:#ff4fa3;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.add-btn:hover{
    background:#ff2f92;
}

        body{
            font-family:Arial, sans-serif;
            display:flex;
            margin:0;
            background:#ffe6f1;
        }

        .sidebar{
            width:220px;
            height:100vh;
            background:#ff4fa3;
            color:white;
            padding:20px;
        }

        .sidebar h2{
            margin-bottom:20px;
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

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            border-radius:10px;
            overflow:hidden;
        }

        th, td{
            padding:12px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        th{
            background:#ff4fa3;
            color:white;
        }

        .status{
            padding:5px 10px;
            border-radius:8px;
            display:inline-block;
        }

        .pending{ background:orange; color:white; }
        .delivered{ background:green; color:white; }

        .btn{
            text-decoration:none;
            padding:6px 10px;
            border-radius:6px;
            font-weight:bold;
            margin:0 3px;
            display:inline-block;
        }

        .done-btn{
            color:green;
        }

        .delete-btn{
            color:red;
        }

        .add-btn{
            display:inline-block;
            margin-bottom:15px;
            padding:10px 15px;
            background:#ff4fa3;
            color:white;
            text-decoration:none;
            border-radius:8px;
            font-weight:bold;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>🌸 Hermes SIMS</h2>
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="deliveries.php">🚚 Deliveries</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <h2>Deliveries</h2>

    <!-- ADD DELIVERY BUTTON -->
    <a href="add_delivery.php" class="add-btn">
    ➕ Add Delivery
</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Address</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>

            <td><?php echo $row['DelID']; ?></td>
            <td><?php echo $row['ProdName']; ?></td>
            <td><?php echo $row['DelQuan']; ?></td>
            <td><?php echo $row['DelDate']; ?></td>
            <td><?php echo $row['DelAdd']; ?></td>

            <td>
                <span class="status <?php echo strtolower($row['DelStatus']); ?>">
                    <?php 
                        if ($row['DelStatus'] == "Pending") {
                            echo "⏳ " . $row['DelStatus'];
                        } else {
                            echo "✅ " . $row['DelStatus'];
                        }
                    ?>
                </span>
            </td>

            <td>

                <a class="btn done-btn"
                   href="update_delivery.php?id=<?php echo $row['DelID']; ?>"
                   onclick="return confirm('Mark this as Delivered?')">
                   🚚 Delivered
                </a>

                <a class="btn delete-btn"
                   href="delete_delivery.php?id=<?php echo $row['DelID']; ?>"
                   onclick="return confirm('Delete this delivery?')">
                   🗑 Delete
                </a>

            </td>

        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>