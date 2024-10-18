<?php
// Substitua estas informações pelas suas credenciais reais do MySQL
$servername = "localhost"; // Geralmente é "localhost" se o banco está no mesmo servidor
$username = "root"; // Substitua pelo seu nome de usuário MySQL real
$password = ""; // Substitua pela sua senha MySQL real
$dbname = "estacionamento"; // Substitua pelo nome do seu banco de dados

// Cria a conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

?>