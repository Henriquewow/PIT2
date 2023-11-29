<?php
session_start();

// Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
$conn = new mysqli("localhost", "root", "", "malote");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID do PA foi passado na URL
if (isset($_GET['id'])) {
    $id_pa = $_GET['id'];

    // Consultar o PA com o ID fornecido
    $query_pa = "SELECT * FROM pa WHERE id = $id_pa";
    $result_pa = $conn->query($query_pa);

    if ($result_pa->num_rows > 0) {
        $pa = $result_pa->fetch_assoc();
    } else {
        echo "PA não encontrado.";
        exit();
    }
} else {
    echo "ID do PA não fornecido.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar PA</title>
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

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
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
        <h2>Editar PA</h2>
        <form action="processar_edicao_pa.php" method="post">
            <input type="hidden" name="id" value="<?php echo $pa['id']; ?>">
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $pa['nome']; ?>" required>

            <label for="data_alteracao">Data de Alteração:</label>
            <input type="text" id="data_alteracao" name="data_alteracao" value="<?php echo $pa['data_alteracao']; ?>" required>

            <label for="quem_alterou">Quem Alterou:</label>
            <input type="text" id="quem_alterou" name="quem_alterou" value="<?php echo $pa['quem_alterou']; ?>" required>

            <label for="malote">Malote:</label>
            <input type="text" id="malote" name="malote" value="<?php echo $pa['malote']; ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
