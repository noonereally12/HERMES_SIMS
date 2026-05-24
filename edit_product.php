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

    mysqli_query($conn, "UPDATE products SET 
        ProdName='$name',
        ProdStock='$stock',
        ProdExp='$exp',
        ProdSupp='$supp',
        ProdPrice='$price'
        WHERE ProdID=$id");

    header("Location: products.php");
    exit();
}
?>

<form method="POST">
    <h2>Edit Product</h2>

    <input type="text" name="name" value="<?php echo $row['ProdName']; ?>"><br>
    <input type="number" name="stock" value="<?php echo $row['ProdStock']; ?>"><br>
    <input type="date" name="exp" value="<?php echo $row['ProdExp']; ?>"><br>
    <input type="text" name="supp" value="<?php echo $row['ProdSupp']; ?>"><br>
    <input type="number" name="price" value="<?php echo $row['ProdPrice']; ?>"><br>

    <button type="submit" name="update">Update</button>
</form>