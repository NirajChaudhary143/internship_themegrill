<?php
include "connection.php";

if (isset($_POST['deleteId'])) {
    $deleteId = $_POST['deleteId'];
    $q = "DELETE FROM `todo` WHERE `id` = $deleteId";
    mysqli_query($conn, $q);
}
