<?php
    // Verificar si la solicitud es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        // Incluir el archivo de conexión a la base de datos
        require_once("conexion.php");

        // Obtener el correo y la contraseña enviados a través de la solicitud POST
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"]; // Contraseña en texto plano

        // Consulta SQL para verificar la existencia del correo y la contraseña en la base de datos
        $query = "SELECT * FROM registro WHERE email = '$email' AND contrasena = '$contrasena'";
        $result = $mysql->query($query);

        // Comprobar si se encontraron resultados en la consulta
        if ($result->num_rows > 0) {
            echo "sesion iniciada";
        } else {
            echo "Usuario o contraseña incorrectos";
        }

        // Cerrar la conexión a la base de datos
        $mysql->close();
    }
