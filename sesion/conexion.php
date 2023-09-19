<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_noticias";

// Crea la conexión
$conn = mysqli_connect($host, $username, $password, $database);

// Verifica si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
