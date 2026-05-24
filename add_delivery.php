<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$products = mysqli_query($conn, "SELECT * FROM products");

if (isset($_POST['add'])) {

    $prodid = $_POST['prodid'];
    $quan = $_POST['quan'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    $status = "Pending";

    mysqli_query($conn, "
        INSERT INTO deliveries (ProdID, DelQuan, DelDate, DelAdd, DelStatus)
        VALUES ('$prodid', '$quan', '$date', '$address', '$status')
    ");

    header("Location: deliveries.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Delivery</title>

    <style>
        body{
            font-family:Arial;
            background:#ffe6f1;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            background:white;
            padding:30px;
            border-radius:15px;
            width:400px;
            box-shadow:0 10px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#ff4fa3;
        }

        input, select{
            width:100%;
            padding:10px;
            margin:8px 0;
            border-radius:8px;
            border:1px solid #ccc;
        }

        button{
            width:100%;
            padding:10px;
            background:#ff4fa3;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
        }

        button:hover{
            background:#ff2f92;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Add Delivery</h2>

    <form method="POST">

        <select name="prodid" required>
            <option value="">Select Product</option>

            <?php while($p = mysqli_fetch_assoc($products)) { ?>
                <option value="<?php echo $p['ProdID']; ?>">
                    <?php echo $p['ProdName']; ?>
                </option>
            <?php } ?>

        </select>

        <input type="number" name="quan" placeholder="Quantity" required>

        <input type="date" name="date" required>

        <input type="text" name="address" placeholder="Delivery Address" required>

        <button type="submit" name="add">Add Delivery</button>

    </form>

</div>

</body>
</html>