<?php
include "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "DELETE FROM `todo` WHERE `id` = $id";
    mysqli_query($conn, $q);
    header("Location: display.php");
}
