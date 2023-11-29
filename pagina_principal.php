<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION["email"])) {
    // Se não estiver autenticado, redireciona para a página de login
    header("Location: login.html");
    exit();
}

// Substitua esta parte com a lógica real de consulta ao banco de dados
$conn = new mysqli("localhost", "root", "", "malote");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$query = "SELECT * FROM pa";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $dados_pa = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $dados_pa = array();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        .consulta-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .pa-box {
            width: 150px;
            height: 150px;
            margin: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            overflow: hidden; /* Adiciona overflow: hidden para evitar que o texto ultrapasse as bordas */
        }

        .green {
            background-color: #2ecc71;
        }

        .red {
            background-color: #e74c3c;
        }

        /* Limita a altura do texto para evitar que ele ultrapasse as bordas do quadrado */
        .pa-box h3,
        .pa-box p {
            margin: 0; /* Adicione esta linha para garantir que não haja margem extra afetando o layout */
            max-height: 30px; /* Ajuste conforme necessário */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="menu">
        <button onclick="location.href='cadastrar_usuario.php'">Cadastrar Usuário</button>
        <button onclick="location.href='cadastrar_pa.php'">Cadastrar PA</button>
        <button onclick="location.href='logout.php'">Sair</button>
    </div>

    <div class="consulta-container">
        <?php foreach ($dados_pa as $pa) : ?>
            <div class="pa-box <?php echo ($pa['malote'] ? 'green' : 'red'); ?>">
                <h3><?php echo $pa['nome']; ?></h3>
                <p><?php echo $pa['data_alteracao']; ?></p>
                <p><?php echo $pa['quem_alterou']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
