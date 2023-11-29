<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
    $conn = new mysqli("localhost", "root", "", "malote");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $query = "SELECT * FROM usuario WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
    } else {
        echo "Usuário não encontrado.";
        exit();
    }

    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    // Processar o formulário de edição quando enviado
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];

    // Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
    $conn = new mysqli("localhost", "root", "", "malote");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $query = "UPDATE usuario SET email='$email', nome='$nome', tipo='$tipo' WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário: " . $conn->error;
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input {
            margin-bottom: 16px;
            padding: 8px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .voltar {
            margin-top: 20px;
            text-align: center;
        }

        .voltar a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" value="<?php echo $usuario['tipo']; ?>" required>

            <button type="submit">Atualizar</button>
        </form>

        <div class="voltar">
            <a href="gerenciar_usuarios.php">Voltar para Gerenciar Usuários</a>
        </div>
    </div>
</body>
</html>
