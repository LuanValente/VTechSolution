<?php
// Conexão com o banco de dados (substitua com suas credenciais)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vtech";

// Cria uma conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    // Usa instrução preparada para inserir os dados no banco de dados
    $sql = "INSERT INTO cadastro (nome, email) VALUES (?, ?)";

    // Prepara a instrução
    $stmt = $conn->prepare($sql);

    if ($stmt === FALSE) {
        die("Erro na preparação da instrução SQL: " . $conn->error);
    }

    // Associa os parâmetros
    $stmt->bind_param("ss", $nome, $email);

    // Executa a instrução preparada
    if ($stmt->execute() === TRUE) {
        echo "Inscrição realizada com sucesso!";
    } else {
        echo "Erro ao realizar a inscrição: " . $stmt->error;
    }

    // Fecha a instrução e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
