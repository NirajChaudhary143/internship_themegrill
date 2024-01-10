<?php

if (isset($_POST['id'])) {
    include "connection.php";
    $queryObj = new Query();
    $id = $_POST['id'];
    $result = $queryObj->showData('todo', $id);
    echo json_encode($result);
}
