<?php
    $servidor='localhost';
    $usuario = 'root';
    $contrasena = 'medac';
    $base_de_datos = 'db_libros';

    $conexion = new Mysqli($servidor,$usuario,$contrasena,$base_de_datos) or die("Error de conexión");
    
?>