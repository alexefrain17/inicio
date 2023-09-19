<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registro de usuarios</title>
</head>
<body>
  <h1>Registro de usuarios</h1>
  <?php if (isset($_GET['error'])) { ?>
    <p>Error: <?php echo $_GET['error']; ?></p>
  <?php } ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    <br>
    <label for="dni">DNI:</label>
    <input type="text" id="dni" name="dni" required>
    <br>
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit" name="register">Registrarse</button>
  </form>
  <p>¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
  
  <?php  
   session_start();  
   $host = "localhost";  
   $username = "root";  
   $password = "";  
   $database = "db_noticias";  
   $message = "";  
   try  
   {  
        $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
        if(isset($_POST["register"]))  
        {  
             if(empty($_POST["nombre"]) || empty($_POST["dni"]) || empty($_POST["email"]) || empty($_POST["password"]))  
             {  
                  $message = '<label>Todos los campos son obligatorios</label>';  
             }  
             else  
             {  
                 $query = "INSERT INTO usuarios (nombre, dni, email, password) VALUES (:nombre, :dni, :email, :password)";  
                 $statement = $connect->prepare($query);  
                 $statement->execute(  
                      array(  
                           'nombre'       =>     $_POST["nombre"],
                           'dni'          =>     $_POST["dni"],
                           'email'        =>     $_POST["email"],
                           'password'     =>     $_POST["password"]  
                      )  
                 );  
                  
                  $count = $statement->rowCount();  
                  if($count > 0)  
                  {  
                       $_SESSION["email"] = $_POST["email"];  
                       header("location: principal.php");  
                  }  
                  else  
                  {  
                       header("location: registrarse.php?error=Error en el registro");  
                  }  
             }  
        }  
   } catch(PDOException $error) {
        $message = $error->getMessage();  
   }
  ?> 
</body>
</html>
