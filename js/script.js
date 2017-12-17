$(".open-delete_user_dialog").click(function() {
    var user_id = $(this).data('user');
    document.getElementById('txtUserId').value = user_id;
    $('#delete_user_dialog').modal('show');
});

$(".open-delete_task_dialog").click(function() {
    var task_id = $(this).data('task');
    document.getElementById('txtTaskId').value = task_id;
    $('#delete_task_dialog').modal('show');
});