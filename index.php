<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5 text-center">
        <h2 class="mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-columns-gap" viewBox="0 0 16 16">
                <path d="M6 1v3H1V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm14 12v3h-5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1zM6 8v7H1V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm14-6v7h-5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1z" />
            </svg> Gerenciador de Tarefas</h2>

        <div class="card p-4 shadow-sm  mx-auto" style="max-width: 900px;border:none;">
            <h4 class="mb-3">Adicionar Nova Tarefa</h4>
            <form id="taskForm">
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Título" required>
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" placeholder="Descrição" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Adicionar</button>
            </form>
        </div>

        <div class="card mt-5 p-4 shadow-sm mx-auto" style="max-width: 900px; border:none;">
            <h4 class="mb-3">Lista de Tarefas</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="taskList">
                        <!-- Tarefas serão carregadas aqui -->
                    </tbody>
                </table>
            </div>
            <div id="pagination" class="mt-3 d-flex justify-content-center"></div>
        </div>
    </div>

    <script>
        function loadTasks(page = 1) {
            $.get('list_tasks.php?page=' + page, function(data) {
                $('#taskList').html(data);
            });
        }

        $('#taskForm').submit(function(e) {
            e.preventDefault();
            $.post('add_task.php', $(this).serialize(), function(response) {
                loadTasks();
                $('#taskForm')[0].reset();
            }, 'json');
            alert("Tarefa cadastrada com sucesso!");
        });

        function completeTask(id) {
            $.post('update_task.php', {
                id: id
            }, function(response) {
                if (response.success) {
                    loadTasks();
                    alert("Informação atualizada com sucesso!\n a Tarefa foi concluida");
                } else {
                    alert('Erro ao concluir a tarefa: ' + response.message);
                }
            }, 'json');
        }


        function deleteTask(id) {
            $.post('delete_task.php', {
                id: id
            }, function() {
                loadTasks();
                alert("A tarefa foi excluida com sucesso");
            });
        }

        $(document).ready(function() {
            loadTasks();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>