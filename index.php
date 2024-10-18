<?php
// Código PHP no início da página para processar o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha

    // Conexão com o banco de dados
    $servername = "localhost"; // Geralmente é "localhost" se o banco está no mesmo servidor
    $username = "root"; // Substitua pelo seu nome de usuário MySQL real
    $password = ""; // Substitua pela sua senha MySQL real
    $dbname = "estacionamento"; // Substitua pelo nome do seu banco de dados

    // Cria a conexão
    $conexao = new mysqli($servername, $username, $password, $dbname);

    // Verifica se houve erro na conexão
    if ($conexao->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
    }

    // Verifica se o email já está cadastrado
    $sql_check = "SELECT * FROM usuarios WHERE email = ?";
    $stmt_check = $conexao->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Email já existe, exibe uma mensagem de erro
        echo "<script>alert('Email já cadastrado! Tente fazer login ou use outro email.');</script>";
    } else {
        // Prepara a consulta SQL para inserir os dados do usuário
        $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

        if ($stmt_insert = $conexao->prepare($sql_insert)) {
            // "sss" indica que estamos passando três strings (nome, email, senha)
            $stmt_insert->bind_param("sss", $nome, $email, $senha);

            // Executa a inserção no banco de dados
            if ($stmt_insert->execute()) {
                echo "<script>alert('Usuário cadastrado com sucesso!');</script>";

            } else {
                echo "<p>Erro ao cadastrar o usuário: " . $stmt_insert->error . "</p>";
            }

            // Fecha a declaração
            $stmt_insert->close();
        } else {
            echo "Erro na preparação da consulta: " . $conexao->error;
        }
    }

    // Fecha a declaração de verificação
    $stmt_check->close();

    

    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Veículos</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.8em;
        }
        h2 {
            color: #555;
            margin-bottom: 30px;
            font-size: 1.5em;
        }
        label {
            display: block;
            margin-bottom: 8px;
            text-align: left;
            font-weight: bold;
            font-size: 14px;
            color: #444;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 25px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #28a745;
            outline: none;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        button {
            width: 48%;
            padding: 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        .login-button {
            background-color: #007bff;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
        img {
            width: 300px;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="https://www.shutterstock.com/image-vector/car-logo-silhouette-minimalist-autocar-600nw-2471568327.jpg" alt="Logo" />
        <h1>Bem-vindo ao Cadastro de Veículos</h1>


        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <div class="button-container">
                <button type="submit">Cadastrar Usuário</button>
                <button type="button" class="login-button" onclick="verificarLogin()">Login</button>
                </div>
        </form>
    </div>

    <script>
    function verificarLogin() {
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;

    // Faz a requisição AJAX para verificar o login
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "verificar_login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {

            window.location.href = 'cadastro.php';
        } else {
            alert(response.message); // Exibe a mensagem de erro
        }
    };

    xhr.send(`email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`);
}
</script>

</body>
</html>
