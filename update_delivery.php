<?php
include 'config.php';

$id = $_GET['id'];
$status = $_GET['status'];

// get delivery info
$delivery = mysqli_query($conn, "SELECT * FROM deliveries WHERE DelID=$id");
$data = mysqli_fetch_assoc($delivery);

$prodid = $data['ProdID'];
$qty = $data['DelQuan'];

// update status
mysqli_query($conn, "
    UPDATE deliveries 
    SET DelStatus='$status' 
    WHERE DelID=$id
");

// ONLY deduct stock when Delivered
if ($status == "Delivered") {

    mysqli_query($conn, "
        UPDATE products 
        SET ProdStock = ProdStock - $qty 
        WHERE ProdID = $prodid
    ");
}

header("Location: deliveries.php");
exit();
?>