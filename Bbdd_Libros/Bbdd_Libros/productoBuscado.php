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
            $busqueda = $_POST["busqueda"];
        
            $sql = $conexion -> prepare("SELECT * FROM libros WHERE titulo LIKE CONCAT('%',?,'%');");
            $sql -> bind_param("s",$busqueda);
            $sql -> execute();
            $resultado = $sql->get_result();
        }
    ?>

    <div class="container">
        <h1 class="text-center">Listado de Productos</h1> <!-- bootstrap -->
        <table class="table table-striped" style="border: 1px solid black;">
            <thead class="table table-dark">
                <tr>
                    <th>Título</th>
                    <th>Páginas</th>
                    <th>Autor</th>
            </thead>
            <tbody>
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    while ($fila = $resultado -> fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $fila["titulo"] ?></td>
                        <td><?php echo $fila["paginas"] ?></td>
                        <td><?php echo $fila["autor"] ?></td>
                    </tr>
                    <?php } }?>
            </tbody>
        </table>
    </div>

</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>