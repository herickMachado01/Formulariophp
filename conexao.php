<?php
$servername = "localhost";
$username = "root"; // Alterar conforme seu usuário
$password = "";     // Alterar conforme sua senha
$database = "meu_banco";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conectado com sucesso";
?>
