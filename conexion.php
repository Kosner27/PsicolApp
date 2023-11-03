<?php
    // Creación de una instancia de la clase mysqli para conectarse a la base de datos MySQL
    $mysql = new mysqli(
        "localhost",  // Dirección del servidor de base de datos (en este caso, servidor local)
        "root",       // Nombre de usuario de la base de datos
        "",           // Contraseña de la base de datos (en este caso, se deja vacía)
        "psicolapp"   // Nombre de la base de datos a la que se desea conectar
    );


