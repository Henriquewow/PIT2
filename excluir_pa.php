<?php
session_start();

// Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
$conn = new mysqli("localhost", "root", "", "malote");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verifica se o ID do PA foi passado na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Exclui o registro do banco de dados
        $query_delete = "DELETE FROM pa WHERE id = $id";

        if ($conn->query($query_delete) === TRUE) {
            // Redireciona para a página de gerenciamento de PAs em caso de sucesso
            header("Location: gerenciar_pa.php");
            exit();
        } else {
            $erro = "Erro ao excluir o registro: " . $conn->error;
        }
    } else {
        $erro = "ID do PA não fornecido.";
    }
} else {
    $erro = "Requisição inválida.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir PA</title>
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

        button {
            background-color: #4caf50; /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Excluir PA</h2>

        <?php if (isset($erro)) : ?>
            <p style="color: red;"><?php echo $erro; ?></p>
            <button onclick="window.location.href='gerenciar_pa.php'">Voltar para Gerenciar PAs</button>
        <?php else : ?>
            <p>Registro excluído com sucesso!</p>
        <?php endif; ?>
    </div>
</body>
</html>
