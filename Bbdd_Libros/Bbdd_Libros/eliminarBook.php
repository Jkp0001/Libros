<?php require 'conexion.php' ?>

<?php
    if(($_SERVER["REQUEST_METHOD"] == "POST")&&($_POST["boton"] == "Eliminar")) {
        $titulo = $_POST["libro"];

        $sql = $conexion -> prepare("DELETE FROM libros WHERE titulo = ?");
        $sql -> bind_param("s",$titulo);
        $sql -> execute();
        header('location:index.php');
    }
    ?>