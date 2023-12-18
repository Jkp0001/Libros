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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $titulo = $_POST["titulo"];
        $paginas = (int) $_POST["paginas"];
        $autor = $_POST["autor"];

        $sql = $conexion -> prepare("INSERT INTO libros VALUES (?,?,?)");
        $sql -> bind_param("sis",$titulo, $paginas, $autor);
        $sql -> execute();
    }
    ?>

    <div class="container">
        <h1>Crear libro</h1>

        <form action="" method="post">

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Páginas</label>
                <input type="text" name="paginas" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control">
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>