<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Veículos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 90%;
            padding: 10px;
            margin: 0 auto 15px; /* Center the input and add margin at the bottom */
            border: 1px solid #ccc;
            border-radius: 100px; /* Rounded corners */
            display: block; /* Make sure the input is a block element */
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }

        button {
            display: inline-block;
            padding: 10px 20px; /* Vertical and horizontal padding */
            background-color: #007bff; /* Background color */
            color: white; /* Text color */
            border: none; /* Remove border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Change cursor to pointer on hover */
            font-size: 16px; /* Font size */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
        }
    </style>
</head>
<body>
    <h1>Cadastro de Veículos</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>

        <label for="ano">Ano:</label>
        <input type="number" id="ano" name="ano" required>

        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required>

        <input type="submit" value="Cadastrar Veículo">
        <button  onclick="window.location.href='monitoramento.php'">Ir para Monitoramento</button>
        </form>

        <a href="index.php">Voltar para pagina de Login</a>
    <?php
    // Código para processar o formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'conexao.php';

        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $ano = $_POST['ano'];
        $placa = $_POST['placa'];

        $sql = "INSERT INTO veiculos (marca, modelo, ano, placa) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssis", $marca, $modelo, $ano, $placa);

        if ($stmt->execute()) {
            echo "<script>alert('Veículo cadastrado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar veículo: " . $conexao->error . "');</script>";
        }

        $stmt->close();
        $conexao->close();
    }
    ?>
</body>
</html>
