<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar o formulário quando enviado
    $email = $_POST["email"];
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    $senha = $_POST["senha"]; // Hash da senha
    $data_cadastro = date("Y-m-d H:i:s"); // Data e hora atual

    // Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
    $conn = new mysqli("localhost", "root", "", "malote");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $query = "INSERT INTO usuario (email, nome, tipo, senha, data_cadastro) VALUES ('$email', '$nome', '$tipo', '$senha', '$data_cadastro')";

    if ($conn->query($query) === TRUE) {
        echo "Usuário criado com sucesso!";
    } else {
        echo "Erro ao criar usuário: " . $conn->error;
    }

    $conn->close();
}
header("Location: cadastro_usuario.php");
exit();
?>
