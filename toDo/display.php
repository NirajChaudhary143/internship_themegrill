<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        include "connection.php";
        $q = "SELECT * FROM todo";
        $result = mysqli_query($conn, $q);
        if (mysqli_num_rows($result) > 0) :
            $loop = 1;
            while ($row = mysqli_fetch_assoc($result)) :
        ?>
                <tr>
                    <td> <?php
                            echo $loop++;
                            ?>
                    </td>
                    <td> <?php
                            echo $row['task'];
                            ?>
                    </td>
                    <td><a href="delete.php?id=<?php echo $row['id'] ?>">Delete</a></td>
                    <td><a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a></td>

                </tr>
        <?php
            endwhile;
        endif
        ?>
    </table>
</body>

</html>