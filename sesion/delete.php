
<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "db_noticias";

    // Crea la conexión
    $connect= mysqli_connect($host, $username, $password, $database);

    // Verifica si la conexión es exitosa
    if (!$connect) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MI PRIMER CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
    <h1 class="text-center p-2 text-center">DATOS DEL USUARIO</h1>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registro de Usuarios</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">NOMBRE</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">EMAIL</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">PASSWORD</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div>
                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">REGISTRAR</button>
            </div>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-danger">
                <tr>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">DNI</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PASSWORD</th>
                    <th scope="col">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM usuarios";
                        $result = mysqli_query($connect, $sql);

                        while($row = mysqli_fetch_assoc($result
                        )) {
                            ?>
                            <tr>
                            <td><?= $row['nombre'] ?></td>
                            <td><?= $row['dni'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['password'] ?></td>
                            <td>
                            <a href="" class="btn btn-small btn-danger">Actualizar</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-small btn-warning">Eliminar</a>

                            </td>
                            </tr>
                            <?php
                                                 }
                                             ?>
                            </tbody>
                            </table>
                            </div>
                            </div>
                            
                            </body>
                            </html>
                            <?php
                                // Cierra la conexión
                                mysqli_close($connect);
                            
                                // Verifica si se ha enviado el formulario
                                if(isset($_POST['btn btn-registrar'])) {
                                    // Obtiene los datos enviados por el formulario
                                    $nombre = $_POST['nombre'];
                                    $dni = $_POST['dni'];
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];
                            
                                    // Inserta los datos en la base de datos
                                    $sql = "INSERT INTO usuarios (nombre, dni, email, password ) VALUES ('$nombre', '$dni', '$email', '$password')";
                            
                                    if (mysqli_query($connect, $sql)) {
                                        echo "<script>alert('Usuario registrado correctamente');</script>";
                                        echo "<script>window.location.replace('index.php');</script>";
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                                    }
                                }
                            ?>