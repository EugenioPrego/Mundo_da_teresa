

<?php


// conexão ao banco de dasdos
try {
    $connect = new PDO("mysql:host=localhost;dbname=mundodateresa", "root", "");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

?>