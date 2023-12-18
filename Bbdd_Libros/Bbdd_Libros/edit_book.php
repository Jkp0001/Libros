<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>
</head>
<body>
<?php
    if(!isset($_GET["libro"])) header('location: index.php');
        if($_SERVER["REQUEST_METHOD"] =="GET"){
        echo "<h1>"."Información sobre: ".$_GET["libro"]."</h1>"; //Accedo mediante el name del input hidden a su value

        $sql = $conexion -> prepare("SELECT * FROM libros WHERE titulo=?" );
        $sql -> bind_param("s",$_GET["libro"]);
        $sql -> execute();
        $resultado = $sql -> get_result();
        $fila = $resultado -> fetch_assoc();

        $paginas = $fila["paginas"];
        $autor = $fila["autor"];
        $titulo = $_GET["libro"];
        }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo_original = $_POST["titulo_original"];
        $titulo = $_POST["titulo"];
        $paginas = $_POST["paginas"];
        $autor = $_POST["autor"];

        $sql = $conexion -> prepare ("UPDATE libros SET titulo=?, paginas = ?, autor = ? WHERE titulo =?");

        $sql -> bind_param("siss", $titulo, $paginas, $autor, $titulo_original);
        $sql -> execute();
        header('location: index.php');
    }
?>



<div class="container">
        <h1>Crear libro</h1>

        <form action="" method="post">
            <input type="hidden" name="titulo_original" value="<?php echo $titulo ?>">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo $titulo ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Páginas</label>
                <input type="text" name="paginas" class="form-control" value="<?php echo $paginas ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" value="<?php echo $autor ?>">
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="Editar">
            </div>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>