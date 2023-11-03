<?php
// Habilitar la visualización de errores en el navegador
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Registros de errores
ini_set('log_errors', 1);
ini_set('error_log', 'C:/Users/Usuario/Desktop/DB/htdocs/PsicolApp/save.php');

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
    
    $nombreCompania = $datos["nombreCompania"];
    $NIT = $datos["NIT"];

    $query = "INSERT INTO registro (Cedula, Nombre, Apellido, NIT, nombreCompania, email, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysql->prepare($query);
    $stmt->bind_param("sssssss", $Cedula, $Nombre, $Apellido, $NIT, $nombreCompania, $email, $contrasena);

    if ($stmt->execute()) {
        echo json_encode(["mensaje" => "Usuario creado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al crear usuario: " . $stmt->error]);
    }
}

// ...

// Asegúrate de establecer el encabezado JSON
header('Content-Type: application/json');

// Obtener los datos enviados a través de la solicitud POST
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    crearUsuario($data);
} else {
    echo json_encode(["error" => "Datos no válidos"]);
}

// Cerrar la conexión a la base de datos
$mysql->close();
?>
[03-Nov-2023 18:13:51 Europe/Berlin] PHP Fatal error:  Uncaught Error: Call to a member function bind_param() on bool in C:\Users\Usuario\Desktop\DB\htdocs\PsicolApp\save.php:29
Stack trace:
#0 C:\Users\Usuario\Desktop\DB\htdocs\PsicolApp\save.php(47): crearUsuario(Array)
#1 {main}
  thrown in C:\Users\Usuario\Desktop\DB\htdocs\PsicolApp\save.php on line 29
[03-Nov-2023 18:19:34 Europe/Berlin] PHP Warning:  mysqli_stmt::bind_param(): Number of elements in type definition string doesn't match number of bind variables in C:\Users\Usuario\Desktop\DB\htdocs\PsicolApp\save.php on line 29
