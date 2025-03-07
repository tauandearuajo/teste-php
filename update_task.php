<?php
// Inclua o arquivo de configuração de conexão com o banco de dados
include 'db.php';
include 'updat_task.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o id da tarefa foi enviado
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $taskId = $_POST['id'];

        // Crie a instância da classe Task e realize a atualização
        $task = new Task($conn);
        $result = $task->updateTask($taskId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            // Caso a execução falhe, retornar a mensagem de erro
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a tarefa.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida']);
}
?>
