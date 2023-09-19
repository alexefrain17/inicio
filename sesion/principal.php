<?php
session_start();
if (!isset($_SESSION['email'])) {
  header('Location: index.php');
  exit();
}
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Página principal</title>
  </head>
  <body>
    <h1>Bienvenido, <?php echo $email; ?></h1>
    <a href="cerrar_sesion.php">Cerrar sesión</a>

    <a href="crud/index.php">Gestionar datos</a>
  </body>
</html>

