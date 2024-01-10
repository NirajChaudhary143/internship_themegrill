<?php

if (isset($_POST['id'])) {
    include "connection.php";
    $queryObj = new Query();
    $id = $_POST['id'];
    $queryObj->deleteData('todo', $id);
}
