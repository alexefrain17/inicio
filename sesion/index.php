<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h1>Iniciar sesión</h1>
  <?php if (isset($_GET['error'])) { ?>
    <p>Error: <?php echo $_GET['error']; ?></p>
  <?php } ?>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit" name="login">Ingresar</button>
    
  </form>
  <h3> no tines cuenta "registrarte" </h3>
  <form action="registrarse.php" method="post">
  <button type="submit" name="register">Registrarse</button>
</form>

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
        if(isset($_POST["login"]))  
        {  
             if(empty($_POST["email"]) || empty($_POST["password"]))  
             {  
                  $message = '<label>Todos los campos son obligatorios</label>';  
             }  
             else  
             {  
                 $query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";  
                 $statement = $connect->prepare($query);  
                 $statement->execute(  
                      array(  
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
                       header("location: index.php?error=Datos incorrectos");  
                  }  
             }  
        }  
   } catch(PDOException $error) {
        $message = $error->getMessage();  
   }
  ?> 
</body>
</html>
