<?php

include "connection.php";
$q = "SELECT * FROM `todo`";
$result = mysqli_query($conn, $q);
while ($row = mysqli_fetch_assoc($result)) {

    $data[] = [
        'id' => $row['id'],
        'task' => $row['task']
    ];
}

echo json_encode($data);
