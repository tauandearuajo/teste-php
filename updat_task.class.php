<?php
class Task {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para atualizar a tarefa
    public function updateTask($id) {
        $query = "UPDATE task SET status = 'concluída', updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Verifique se a preparação da consulta foi bem-sucedida
        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

        $stmt->bind_param('i', $id); // 'i' para indicar que o parâmetro é um inteiro

        // Executar a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            // Caso a execução falhe, retorne false
            return false;
        }
    }
}
?>
