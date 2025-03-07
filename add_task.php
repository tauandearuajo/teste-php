<?php
// add_task.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $status = 'pendente';
    $created_at = date('Y-m-d H:i:s');
    $created_by = 'admin'; // Pode ser dinâmico se houver autenticação

    if (!empty($title) && !empty($description)) {
        $sql = "INSERT INTO task (title, description, status, created_at, created_by) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sssss", $title, $description, $status, $created_at, $created_by);
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Tarefa adicionada com sucesso!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Erro ao adicionar tarefa: " . $stmt->error]);
            }
            $stmt->close();
        } else {
            echo json_encode(["success" => false, "message" => "Erro na preparação da query: " . $conn->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Título e descrição são obrigatórios."]);
    }
}
$conn->close();
?>
