<?php
// Incluir el archivo de conexión a la base de datos
require_once("conexion.php");

// Función para crear un nuevo usuario
function crearUsuario($datos) {
    global $mysql;
    
    $Cedula = $datos["Cedula"];
    $Nombre = $datos["Nombre"];
    $Apellido = $datos["Apellido"];
    $email = $datos["email"];
    $contrasena = $datos["contrasena"];
    $foto = $datos["foto"];
    $nombreCompania = $datos["nombreCompania"];
    $NIT = $datos["NIT"];

    $query = "INSERT INTO registro (Cedula, Nombre, Apellido, NIT, nombreCompania, email, contrasena, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("ssssssss", $Cedula, $Nombre, $Apellido, $NIT, $nombreCompania, $email, $contrasena, $foto);

    if ($stmt->execute()) {
        return ["mensaje" => "Usuario creado correctamente"];
    } else {
        return ["error" => "Error al crear usuario: " . $stmt->error];
    }
}

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Obtener los datos enviados a través de la solicitud POST
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data) {
        $respuesta = crearUsuario($data);
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["error" => "Datos no válidos"]);
    }
}

// Cerrar la conexión a la base de datos
$mysql->close();
?>
