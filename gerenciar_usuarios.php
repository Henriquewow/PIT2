<?php
// Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
$conn = new mysqli("localhost", "root", "", "malote");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$query = "SELECT * FROM usuario";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $usuarios = array();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .acao {
            text-align: center;
        }

        .acao form {
            display: inline;
        }

        .acao button {
            text-decoration: none;
            color: #333;
            margin-right: 10px;
            padding: 5px 10px;
            border: 1px solid #333;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Gerenciar Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data de Cadastro</th>
                    <th class="acao">Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
    <tr>
        <td><?php echo $usuario['email']; ?></td>
        <td><?php echo $usuario['nome']; ?></td>
        <td><?php echo $usuario['tipo']; ?></td>
        <td><?php echo $usuario['data_cadastro']; ?></td>
        <td class="acao">
            <form action="editar_usuario.php" method="get" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                <button type="submit">Editar</button>
            </form>
            <form action="excluir_usuario.php" method="get" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                <button type="submit" name="excluir">Excluir</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>


            </tbody>
        </table>

        <div class="voltar">
            <a href="pagina_principal.php">Voltar para a Página Inicial</a>
        </div>
    </div>
</body>
</html>
