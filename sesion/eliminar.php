<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "db_noticias";

    // Crea la conexión
    $connect = mysqli_connect($host, $username, $password, $database);

    // Verifica si la conexión es exitosa
    if (!$connect) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Verifica si se ha enviado el formulario
    if(isset($_GET['id'])) {
        // Obtiene el ID enviado por la URL
        $id = $_GET['id'];

        // Elimina el registro correspondiente en la base de datos
        $sql = "DELETE FROM usuarios WHERE id = $id";

        if (mysqli_query($connect, $sql)) {
            echo "<script>alert('Usuario eliminado correctamente');</script>";
            echo "<script>window.location.replace('index.php');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }
    }

    // Cierra la conexión
    mysqli_close($connect);
?>
