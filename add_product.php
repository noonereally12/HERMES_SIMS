<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $exp = $_POST['exp'];
    $supp = $_POST['supp'];
    $price = $_POST['price'];

    $query = "INSERT INTO products (ProdName, ProdStock, ProdExp, ProdSupp, ProdPrice)
              VALUES ('$name', '$stock', '$exp', '$supp', '$price')";

    mysqli_query($conn, $query);

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>

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

        input{
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
    </style>
</head>

<body>

<div class="box">
    <h2>Add Product</h2>

    <form method="POST">

        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="stock" placeholder="Stock" required>
        <input type="date" name="exp" required>
        <input type="text" name="supp" placeholder="Supplier" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>

        <button type="submit" name="add">Add Product</button>

    </form>
</div>

</body>
</html>