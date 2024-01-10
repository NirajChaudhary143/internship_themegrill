<?php

if (isset($_POST['id'])) {
    include "connection.php";
    $id = $_POST['id'];
    $updatedTask = $_POST['task'];
    $q = "UPDATE `todo` SET `task` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($stmt, "si", $updatedTask, $id);
    mysqli_stmt_execute($stmt);
}
