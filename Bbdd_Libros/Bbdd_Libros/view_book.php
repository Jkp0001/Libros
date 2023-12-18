<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View_Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>

</head>
<body>
    <?php
        if(!isset($_GET["libro"])) header('location: index.php');
        echo "<h1>"."Información sobre: ".$_GET["libro"]."</h1>"; //Accedo mediante el name del input hidden a su value

        $sql = $conexion -> prepare("SELECT * FROM libros WHERE titulo=?" );
        $sql -> bind_param("s",$_GET["libro"]);
        $sql -> execute();
        $resultado = $sql -> get_result();

        $fila = $resultado -> fetch_assoc();
    ?>
    
    <div class="container"></div>
        <?php echo "Título: ".$fila["titulo"]."<br>" ?>
        <?php echo "Páginas: ".$fila["paginas"]."<br>" ?>
        <?php echo "Autor: ".$fila["autor"] ?>


        <div class="row mb-3">
            <div class=col-1>
                <form action="edit_book.php" method="GET">
                    <input type="hidden" name="libro" value="<?php echo $_GET['libro']?>">
                    <input type="submit" class="btn btn-primary" value="Editar">
                </form>
            </div>
            <div class="col-1">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </div>
    </div>
    <?php
        $conexion -> close(); //cerrar conexión
    ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>