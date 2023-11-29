<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
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
        <h2>Cadastrar Usuário</h2>
        <form method="post" action="processar_cadastro_usuario.php">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <div class="voltar">
            <a href="pagina_principal.php">Voltar para a Página Inicial</a>
        </div>

        <div class="voltar">
            <a href="gerenciar_usuarios.php">Gerenciar Usuários</a>
        </div>
    </div>
</body>
</html>
