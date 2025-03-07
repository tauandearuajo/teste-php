<?php
$host = 'localhost';
$user = 'root';
$pass = 'Projeto@228638';
$dbname = 'teste_php';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





?>