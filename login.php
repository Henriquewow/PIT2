<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados (usuário: root, senha: vazia)
    $conn = new mysqli("localhost", "root", "", "malote");

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Obtém dados do formulário
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta SQL para verificar o usuário e senha
    $query = "SELECT * FROM usuario WHERE email='$email' AND senha='$password'";
    $result = $conn->query($query);

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Inicia a sessão e redireciona para a página principal
        session_start();
        $_SESSION["email"] = $email;
        header("Location: pagina_principal.php");
    } else {
        // Exibe uma mensagem de erro se a autenticação falhar
        echo "Usuário ou senha inválidos.";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
