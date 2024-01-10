<?php

include "connection.php";

if (isset($_POST['task'], $_POST['id'])) {
    $queryObj = new Query();
    $id = $_POST['id'];
    $task = $_POST['task'];
    $taskArr = array(
        'task' => $task
    );
    $queryObj->updateData('todo', $id, $taskArr);
}
