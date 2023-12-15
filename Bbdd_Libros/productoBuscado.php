<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $_SERVER["REQUEST_METHOD"] == "POST"{
            $busqueda = $_POST["busqueda"];
        }

        $sql = $conexion -> prepare("SELECT * FROM libros WHERE titulo=?;");
        $sql -> bind_param("s",$busqueda);
        $sql -> execute();
        $resultado = $sql->get_result();
    ?>

    <div class="container">
        <h1 class="text-center">Listado de Productos</h1> <!-- bootstrap -->
        <table class="table table-striped" style="border: 1px solid black">
            <thead class="table table-dark">
                <tr>
                    <th>Título</th>
                    <th>Páginas</th>
                    <th>Autor</th>
            </thead>
            <tbody>
                <?php
                    while ($fila = $resultado -> fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $fila["titulo"] ?></td>
                        <td><?php echo $fila["paginas"] ?></td>
                        <td><?php echo $fila["autor"] ?></td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>