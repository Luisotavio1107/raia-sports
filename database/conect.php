<?php
$host = "192.168.10.68";
$dbname = "raia";
$user = "loja";
$pass = "12345";

try {
    $conexao = new PDO(
        "pgsql:host=$host;dbname=$dbname",
        $user,
        $pass
    );
    // echo "Conexão realizada com sucesso!";
    return $conexao;
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>