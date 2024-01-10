<?php
$task =  $_POST['task'];
include "connection.php";

$q = "INSERT INTO todo (`task`) VALUES (?)";

$stmt = mysqli_stmt_init($conn);
$prepared = mysqli_stmt_prepare($stmt, $q);
mysqli_stmt_bind_param($stmt, 's', $task);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$q = "SELECT * FROM todo";
$res = mysqli_query($conn, $q);
while ($row = mysqli_fetch_assoc($res)) {
    $arr[] = $row;
}
$arr[] = ['status' => true];

echo json_encode($arr);
