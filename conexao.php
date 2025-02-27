<?php 

$host = "localhost";
$db_name = "api_db";
$username = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$host; dbname=$db_name;charset=utf8", $username, $password);
    $pdo ->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

} catch (PDOException $e ) {
    die("Erro na conexão: " . $e->getMessage());
}
?>