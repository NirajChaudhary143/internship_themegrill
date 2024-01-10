function addData() {
    var txt = $("#btn").text();
    var task = $("#todo").val();
    if (txt == "Update") {
        var id = $("#btn").attr("data-id");
        $.ajax({
            url: 'update.php',
            type: 'post',
            data: {
                id: id,
                task: task
            },
            success: function(result) {
                getData();
                $("#btn").text("Add");
                $("#todo").val('');
            }
        });
    } else {
        $.ajax({
            url: 'addData.php',
            type: 'post',
            data: {
                task: task
            },
            success: function(result) {
                getData();
            }
        });
    }
}

function getData() {
    $.ajax({
        url: "getData.php",
        type: 'post',
        success: function(data) {
            var displayData = JSON.parse(data);
            var $row = "";
            var loop = 0;
            displayData.forEach(element => {
                ++loop;
                $row += "<tr><td>" + loop + "</td>" + "<td>" + element.task + "</td><td><button onclick='DeleteData(" + element.id + ")'>Delete</button><button onclick='updateData(" + element.id + ")'>Edit</button></td></tr>";
            });
            var html = `
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>
                    Action
                    </th>
                </tr>
            </thead>
            <tbody>
                ${$row}
            </tbody>
        </table>
        `;
            $("#showData").html(html);
            $("#todo").val('');
        }
    });
}

$(document).ready(function() {
    getData();
});

function DeleteData($id) {
    var id = $id;
    var conf = confirm("Confirm to delete the todo.");
    if (conf) {
        $.ajax({
            url: 'deleteData.php',
            type: 'post',
            data: {
                id: id
            },
            success: function(result) {
                getData();
            }
        });
    }
}

function updateData($id) {
    var id = $id;
    $.ajax({
        url: 'edit.php',
        type: 'post',
        data: {
            id: id
        },
        success: function(result) {
            var data = JSON.parse(result);
            data.forEach(element => {
                $("#todo").val(element.task);
                $("#btn").text("Update");
                $("#btn").attr('data-id', element.id);
            });
        }
    });
}