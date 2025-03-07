<?php
// list_tasks.php
include 'db.php';

$limit = 5; // Número de tarefas por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM task ORDER BY created_at DESC LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['title']}</td>";
    echo "<td>{$row['description']}</td>";
    echo "<td>Status: {$row['status']}</td>";
    echo "<td><button class='btn btn-success' onclick='completeTask({$row['id']})'>Concluir</button> <button class='btn btn-danger' onclick='deleteTask({$row['id']})'>Excluir</button></td>";
    echo "</tr>";
}

// Paginação
$total_sql = "SELECT COUNT(*) FROM task";
$total_result = $conn->query($total_sql);
$total_tasks = $total_result->fetch_row()[0];
$total_pages = ceil($total_tasks / $limit);

echo "<div>";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<button onclick='loadTasks($i)'>$i</button> ";
}
echo "</div>";

$conn->close();
?>
