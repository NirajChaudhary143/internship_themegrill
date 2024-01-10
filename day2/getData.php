<?php
include "connection.php";

$queryObj = new Query();
$result = $queryObj->showData('todo');
echo json_encode($result);
