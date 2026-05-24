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
    <title>Deliveries</title>

    <style>
        body{
            font-family:Arial;
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

        .btn{
            display:inline-block;
            margin-bottom:10px;
            padding:10px 15px;
            background:#ff4fa3;
            color:white;
            text-decoration:none;
            border-radius:8px;
        }

        .status{
            padding:5px 10px;
            border-radius:8px;
            display:inline-block;
        }

        .pending{
            background:orange;
            color:white;
        }

        .delivered{
            background:green;
            color:white;
        }

        select{
            padding:5px;
            border-radius:6px;
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

    <h2>Deliveries</h2>

    <a class="btn" href="add_delivery.php">+ Add Delivery</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Date</th>
            <th>Address</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>

            <td><?php echo $row['DelID']; ?></td>
            <td><?php echo $row['ProdName']; ?></td>
            <td><?php echo $row['DelQuan']; ?></td>
            <td><?php echo $row['DelDate']; ?></td>
            <td><?php echo $row['DelAdd']; ?></td>

            <td>
                <form method="GET" action="update_delivery.php">
                    <input type="hidden" name="id" value="<?php echo $row['DelID']; ?>">

                    <select name="status" onchange="this.form.submit()">

                        <option value="Pending"
                        <?php if($row['DelStatus']=="Pending") echo "selected"; ?>>
                            Pending
                        </option>

                        <option value="Delivered"
                        <?php if($row['DelStatus']=="Delivered") echo "selected"; ?>>
                            Delivered
                        </option>

                    </select>
                </form>
            </td>

        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>