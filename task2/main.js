function addData() {

    var text = $("#btn").text();
    if (text == "Update") {
        var task = $("#todo").val();
        var id = $("#btn").val();
        $.ajax({
            url: 'update.php',
            type: 'post',
            data: {
                id: id,
                task: task
            },
            success: function(result) {
                $("#todo").val('');
                $("#btn").text("Submit");
                getData();
            }


        });
    } else {

        var task = $("#todo").val();
        $.ajax({
            url: 'save.php',
            type: 'post',
            data: {
                task: task,
            },
            success: function(result) {
                var data = JSON.parse(result);
                console.log(data);
                data.forEach(element => {
                    if (element.status) {
                        $("#todo").val('');
                    }
                });
                getData();
            }
        });
    }
}

function getData() {


    $.ajax({
        url: 'getData.php',
        type: 'post',
        success: function(result) {
            var data = JSON.parse(result);
            var rows = '';
            var loop = 0;
            data.forEach(element => {
                rows += `
                    <tr>
                        <td>${++loop}</td>
                        <td>${element.task}</td>
                        <td>
                        <button onclick="Delete(${element.id})">Delete</button>
                        <button onclick="Update(${element.id})">Update</button>
                        </td>
                    </tr>
                `;
            });

            var html = `
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${rows} 
                    </tbody>
                </table>
            `;
            $('#showData').html(html);
        }
    });

}

$(document).ready(function() {
    getData();
});


function Delete(deleteId) {
    conf = confirm("Are you sure to delete this task");
    if (conf) {
        $.ajax({
            url: 'deleteTask.php',
            type: 'post',
            data: {
                deleteId: deleteId
            },
            success: function(result) {
                getData()
            }
        });
    }
}

function Update(id) {
    $.ajax({
        url: 'edit.php',
        type: 'post',
        data: {
            id: id
        },
        success: function(result) {
            var data = JSON.parse(result);
            $("#todo").val(data.task);
            $("#btn").text("Update");
            $("#btn").val(data.id);

        }
    });
}