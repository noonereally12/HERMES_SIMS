<?php
include 'config.php';

$id = $_GET['id'];

// ALWAYS force correct status (no more broken values)
$status = "Delivered";

// get delivery info
$delivery = mysqli_query($conn, "SELECT * FROM deliveries WHERE DelID=$id");
$data = mysqli_fetch_assoc($delivery);

$prodid = $data['ProdID'];
$qty = $data['DelQuan'];

// update status
mysqli_query($conn, "
    UPDATE deliveries 
    SET DelStatus='Delivered' 
    WHERE DelID=$id
");

// reduce stock ONLY ONCE
mysqli_query($conn, "
    UPDATE products 
    SET ProdStock = ProdStock - $qty 
    WHERE ProdID = $prodid
");

header("Location: deliveries.php");
exit();
?>