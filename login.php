<?php
include 'config.php';

session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM accounts 
              WHERE AccName='$username' 
              AND AccPass='$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $row['AccName'];
        $_SESSION['role'] = $row['AccRole'];

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Hermes SIMS Login</title>

    <link rel="stylesheet" href="css/style.css?v=1">

</head>

<body>

<div class="login-container">

    <h2>Hermes SIMS</h2>

    <p class="subtitle">
        Inventory Management System
    </p>

    <form method="POST">

        <input type="text"
               name="username"
               placeholder="Enter Username"
               required>

        <input type="password"
               name="password"
               placeholder="Enter Password"
               required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>

</div>

<script src="js/script.js"></script>

</body>
</html>