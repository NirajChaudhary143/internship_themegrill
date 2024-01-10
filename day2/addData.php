<?php
include "connection.php";

if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $queryObj = new Query();
    // echo json_encode($task);
    $filed = [
        'task' => $task
    ];

    $queryObj->addData('todo', $filed);
}
