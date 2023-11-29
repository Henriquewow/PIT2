<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar o formulário de cadastro quando enviado
    $nome = $_POST['nome'];
    $data_alteracao = date("Y-m-d H:i:s"); // Data atual
    $quem_alterou = $_SESSION['usuario']; // Nome da pessoa logada
    $malote = isset($_POST['malote']) ? 1 : 0;

    // Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
    $conn = new mysqli("localhost", "root", "", "malote");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $query_insert = "INSERT INTO pa (nome, data_alteracao, quem_alterou, malote) VALUES ('$nome', '$data_alteracao', '$quem_alterou', $malote)";

    if ($conn->query($query_insert) === TRUE) {
        echo "PA cadastrada com sucesso!";
        header("Location: cadastrar_pa.php"); // Redirecionar para a página de cadastro após sucesso
        exit();
    } else {
        echo "Erro ao cadastrar PA: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar PA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .voltar {
            margin-top: 20px;
        }

        .voltar a,
        .botao {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #333;
            border-radius: 4px;
            display: inline-block;
        }

        .botao {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar PA</h2>

        <form action="cadastrar_pa.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <!-- A data de alteração e quem alterou são preenchidos automaticamente no lado do servidor -->

            <label for="malote">Malote:</label>
            <input type="checkbox" name="malote">

            <button type="submit" class="botao">Cadastrar PA</button>
        </form>

        <div class="voltar">
            <a href="pagina_principal.php" class="botao">Voltar para Página Principal</a>
            <a href="gerenciar_pa.php" class="botao">Ir para Gerenciar PAs</a>
        </div>
    </div>
</body>
</html>
