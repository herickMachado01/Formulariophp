// cadastrar.php
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

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$idade = $_POST['idade'];

$sql = "INSERT INTO pessoas (CPF, Nome, Endereço, Telefone, Email, Idade) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $cpf, $nome, $endereco, $telefone, $email, $idade);

if ($stmt->execute()) {
    echo "Registro inserido com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: index.php");
exit();
?>
