<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM products WHERE ProdID=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $stock = $_POST['stock'];
    $exp = $_POST['exp'];
    $supp = $_POST['supp'];
    $price = $_POST['price'];

    mysqli_query($conn, "
        UPDATE products SET
        ProdName='$name',
        ProdStock='$stock',
        ProdExp='$exp',
        ProdSupp='$supp',
        ProdPrice='$price'
        WHERE ProdID=$id
    ");

    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>

    <style>
        body{
            font-family:Arial;
            background:#ffe6f1;
            margin:0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .box{
            width:400px;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 10px 20px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#ff4fa3;
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
            font-weight:bold;
            cursor:pointer;
        }

        button:hover{
            background:#ff2f92;
        }

    </style>
</head>

<body>

<div class="box">

    <h2>Edit Product</h2>

    <form method="POST">

        <input type="text" name="name" value="<?php echo $row['ProdName']; ?>" required>
        <input type="number" name="stock" value="<?php echo $row['ProdStock']; ?>" required>
        <input type="date" name="exp" value="<?php echo $row['ProdExp']; ?>" required>
        <input type="text" name="supp" value="<?php echo $row['ProdSupp']; ?>" required>
        <input type="number" name="price" value="<?php echo $row['ProdPrice']; ?>" required>

        <button type="submit" name="update">Update Product</button>

    </form>

</div>

</body>
</html>