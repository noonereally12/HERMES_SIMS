<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "hermes_sims",
    3307
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>