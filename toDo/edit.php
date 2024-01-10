<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOdo</title>
</head>
<?php
$task = "";
include "connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $q = "SELECT * FROM todo WHERE id=$id";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($result);
    $task = $row['task'];
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

<body>
    <form action="edit.php?id= <?php echo $_GET['id'] ?>" method="POST">
        <label for="">Input Todo</label>
        <input type="text" name="todo" value="<?php echo $task ?>">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>

</html>