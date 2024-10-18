<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "estacionamento";

    // Cria a conexão
    $conexao = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Prepara a consulta SQL para buscar o usuário
    $sql_check = "SELECT * FROM usuarios WHERE email = ?";
    $stmt_check = $conexao->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Verifica a senha
        if (password_verify($senha, $usuario['senha'])) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não encontrado.']);
    }

    // Fecha a conexão
    $stmt_check->close();
    $conexao->close();
}
?>
