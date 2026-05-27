<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['search'])) {

    $search = $_GET['search'];

    $query = "
        SELECT * FROM products
        WHERE ProdName LIKE '%$search%'
        ORDER BY ProdName ASC
    ";
}
else {

    $query = "
        SELECT * FROM products
        ORDER BY ProdName ASC
    ";
}

$result = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html>
<head>
<title>Products</title>

<style>

.add-btn{
    display:inline-block;
    margin-bottom:15px;
    padding:10px 15px;
    background:#ff4fa3;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.add-btn:hover{
    background:#ff2f92;
}

body{
    font-family:Arial;
    margin:0;
    display:flex;
    background:linear-gradient(135deg,#ffe6f1,#ffd1e8);
}

.sidebar{
    width:240px;
    height:100vh;
    background:linear-gradient(180deg,#ff4fa3,#ff2f92);
    color:white;
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:12px;
    margin:8px 0;
    border-radius:10px;
    background:rgba(255,255,255,0.15);
}

.sidebar a:hover{
    background:white;
    color:#ff4fa3;
}

.main{
    flex:1;
    padding:30px;
}

.btn{
    display:inline-block;
    padding:10px 15px;
    background:#ff4fa3;
    color:white;
    text-decoration:none;
    border-radius:10px;
    margin-bottom:10px;
}

.search-box{

    width:250px;

    padding:10px;

    border-radius:8px;

    border:1px solid #ccc;

    margin-bottom:15px;
}

.search-btn{

    padding:10px 15px;

    background:#ff4fa3;

    color:white;

    border:none;

    border-radius:8px;

    cursor:pointer;
}

.logo-title{

    display:flex;

    align-items:center;

    gap:10px;
}

.logo{

    width:40px;
    height:40px;

    border-radius:50%;

    object-fit:cover;
}

table{
    width:100%;
    background:white;
    border-collapse:collapse;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

th{
    background:#ff4fa3;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    text-align:center;
}

tr:nth-child(even){
    background:#fff5fa;
}

.expired{
    color:red;
    font-weight:bold;
}

.expiry{
    color:orange;
    font-weight:bold;
}
</style>

</head>

<body>

<div class="sidebar">

    <h2 class="logo-title">
        <img src="images/HERMES.png" class="logo">
        Hermes SIMS
    </h2>

    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="products.php">📦 Products</a>
    <a href="deliveries.php">🚚 Deliveries</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<h2>Products</h2>

<a href="add_product.php" class="add-btn">
    ➕ Add Product
</a>

<form method="GET">

    <input type="text"
           name="search"
           class="search-box"
           placeholder="Search product...">

    <button type="submit"
            class="search-btn">

        Search

    </button>

</form>

<table>
<tr>

<th>Name</th>
<th>Stock</th>
<th>Expiry</th>
<th>Supplier</th>
<th>Price</th>
<th>Action</th>
</tr>



<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>


<td><?php echo $row['ProdName']; ?></td>

<td style="<?php echo ($row['ProdStock'] <= 25) ? 'color:red; font-weight:bold;' : 'color:black;'; ?>">
    <?php echo $row['ProdStock']; ?>
</td>

<?php

$today = date('Y-m-d');
$Expiry = date('Y-m-d', strtotime('+7 days'));

$expDate = $row['ProdExp'];

if ($expDate <= $today) {

    echo "<td class='expired'>
            $expDate
          </td>";

}
else if ($expDate < $Expiry) {

    echo "<td class='expiry'>
            $expDate
          </td>";

}
else {

    echo "<td>
            $expDate
          </td>";
}
?>



<td><?php echo $row['ProdSupp']; ?></td>
<td><?php echo $row['ProdPrice']; ?></td>

<td>
<a href="edit_product.php?id=<?php echo $row['ProdID']; ?>">Edit</a> |
<a href="delete_product.php?id=<?php echo $row['ProdID']; ?>">Delete</a>
</td>

</tr>
<?php } ?>

</table>

</div>

</body>
</html>
