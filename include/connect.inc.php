<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "BlogBase";
$con = mysqli_connect($hostName, $userName , $password, $databaseName);

if (!$con) {
    echo "<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>not able to establish database connection</h3>";
}

$sql = "SELECT *
        FROM `Articles`";
$query = mysqli_query($con, $sql);
?>
