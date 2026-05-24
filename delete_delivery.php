<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM deliveries WHERE DelID=$id");

header("Location: deliveries.php");
exit();
?>