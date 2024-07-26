<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoas</title>
    <!-- Incluindo Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Cadastro de Pessoas</h1>
        <form action="cadastrar.php" method="post">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="idade" name="idade">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>

        <h2 class="mt-5">Lista de Pessoas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conectar ao banco de dados
                $conn = new mysqli("localhost", "root", "", "meu_banco");

                // Verificar conexão
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Buscar dados
                $sql = "SELECT * FROM pessoas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['CPF']}</td>
                                <td>{$row['Nome']}</td>
                                <td>{$row['Endereço']}</td>
                                <td>{$row['Telefone']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['Idade']}</td>
                                <td>
                                    <a href='editar.php?cpf={$row['CPF']}' class='btn btn-warning btn-sm'>Editar</a>
                                    <a href='excluir.php?cpf={$row['CPF']}' class='btn btn-danger btn-sm'>Excluir</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Nenhum registro encontrado</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Incluindo Bootstra
