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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];

    $sql = "UPDATE pessoas SET Nome=?, Endereço=?, Telefone=?, Email=?, Idade=? WHERE CPF=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $endereco, $telefone, $email, $idade, $cpf);

    if ($stmt->execute()) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT * FROM pessoas WHERE CPF=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();
    $pessoa = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Pessoa</h1>
        <form action="editar.php?cpf=<?php echo $cpf; ?>" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $pessoa['Nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" value="<?php echo $pessoa['Endereço']; ?>">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $pessoa['Telefone']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $pessoa['Email']; ?>">
            </div>
            <div class="form-group">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="idade" name="idade" value="<?php echo $pessoa['Idade']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
