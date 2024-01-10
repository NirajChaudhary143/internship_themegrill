
<?php
$task = "";
include "connection.php";
if (isset($_POST['id'])) {
    $id = $_POST['id'];


    $q = "SELECT * FROM todo WHERE id=$id";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
}

if (isset($_POST['submit'])) {
    $updatedTask = $_POST['todo'];
    $id = $_GET['id'];

    $q = "UPDATE `todo` SET `task` = ? WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $q);
    mysqli_stmt_bind_param($stmt, "si", $updatedTask, $id);
    mysqli_stmt_execute($stmt);

    header("Location: display.php");
}
?>

