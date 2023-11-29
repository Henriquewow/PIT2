<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Substitua "nome_do_seu_banco_de_dados" pelo nome real do seu banco de dados
    $conn = new mysqli("localhost", "root", "", "malote");

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $id = $_GET['id'];

    // Use prepared statement para evitar SQL injection
    $stmt = $conn->prepare("DELETE FROM usuario WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

header("Location: gerenciar_usuarios.php");
exit();
?>
