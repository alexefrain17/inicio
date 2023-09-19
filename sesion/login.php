<?php
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['email'])) {
  header('Location: welcome.php');
  exit();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['email']) && isset($_POST['password'])) {
  // Conectar a la base de datos
  $mysqli = new mysqli("localhost", "user", "password", "user_db");

  // Verificar la conexión
  if ($mysqli->connect_error) {
    die("Error de conexión a la base de datos: " . $mysqli->connect_error);
  }

  // Recibir los datos del formulario
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);

  // Buscar el usuario en la base de datos
  $sql = "SELECT `password` FROM `user` WHERE `email` = '$email'";
  $result = $mysqli->query($sql);

  // Verificar si el usuario existe y si la contraseña es correcta
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      // Iniciar sesión
      $_SESSION['email'] = $email;
      header('Location: welcome.php');
      exit();
    } else {
      $error = "Contraseña incorrecta.";
    }
  } else {
    $error = "Usuario no encontrado.";
  }

  // Liberar el resultado
  $result->free();

  // Cerrar la conexión
  $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Iniciar sesión</h1>
    <?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post">
      <label for="email">Correo electrónico:</label>
      <input type="email" name="email" required><br>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" required><br>
      <button type="submit">Iniciar sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="register.php"><br>Regístrate aquí</a>.</p>
  </div>
</body>
</html>
