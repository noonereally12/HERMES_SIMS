<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM products WHERE ProdID=$id");

header("Location: products.php");
exit();
?>