$(document).ready(function() {
    // Cargar tareas al cargar la página
    loadTasks();

    // Enviar el formulario para agregar una nueva tarea
    $("#taskForm").submit(function(event) {
        event.preventDefault();
        var taskInput = $("#taskInput").val();
        $.post("task.php", { action: "create", task: taskInput }, function() {
            alert("tarea created");
            loadTasks();
        });
    });

    // Eliminar tarea al hacer clic en el botón Eliminar
    $(document).on("click", ".deleteBtn", function() {
        var id = $(this).closest("li").data("id");
        $.post("task.php", { action: "delete", id: id }, function() {
            alert("tarea deleted");
            loadTasks();
        });
    });

    // Función para cargar tareas
    function loadTasks() {
        $("#taskList").load("task.php");
    }
});
