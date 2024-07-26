// excluir.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "meu_banco";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$cpf = $_GET['cpf'];

$sql = "DELETE FROM pessoas WHERE CPF=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cpf);

if ($stmt->execute()) {
    echo "Registro excluído com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit();
?>
