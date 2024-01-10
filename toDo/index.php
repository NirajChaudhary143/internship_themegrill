<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOdo</title>
</head>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['todo'];
    include "connection.php";

    $q = "INSERT INTO `todo` (`task`) VALUES (?)";
    $stmt = mysqli_stmt_init($conn);
    $prepare = mysqli_stmt_prepare($stmt, $q);
    if ($prepare) {
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt);
    }
    header("location: display.php");
}
?>

<body>
    <form action="index.php" method="POST">
        <label for="">Input Todo</label>
        <input type="text" name="todo">
        <br>
        <input type="submit" name="submit">

    </form>
</body>

</html>