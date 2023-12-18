<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php require 'conexion.php' ?>
</head>
    <style>
        .filtros{
            margin-top: 3px;
        }
    </style>
<body>
    <?php
    
    $opciones = "titulo";
    $orden = "DESC";
    $busqueda = "%%";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $busqueda = "%". $_POST["busqueda"]. "%"; 
        $opciones = $_POST["opciones"];
        $orden = $_POST["orden"];
    }

    $sql = $conexion -> prepare("SELECT * FROM libros WHERE titulo LIKE ? ORDER BY $opciones $orden");
    $sql -> bind_param("s",$busqueda);
    $sql -> execute();
    $resultado = $sql -> get_result();

    $conexion -> close(); //cerrar conexión
    ?>

    <div class="container">
        <h1 class="text-center">Listado de Productos</h1> <!-- bootstrap -->

        <!-- Navegador -->
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-4">
                    <input class="form-control" type="search" name="busqueda" placeholder="Eragon, El Quijote,..">
                </div>

                <div class="col-2">
                    <input class="btn btn-primary" type="submit" value="Buscar">
                </div>
        <!-- Navegador -->

                <!-- Filtros -->
                <div class="col-2 filtros">
                    <label class="form-label">Filtros: </label>
                    <select name="opciones" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="titulo" selected>Título</option>
                        <option value="paginas">Páginas</option>
                        <option value="autor">Autor/a</option>
                    </select>
                </div>

                <div class="col-3 filtros">
                    <select name="orden" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option value="ASC">Ascendente</option>
                        <option value="DESC" selected>Descendente</option>
                    </select>
                </div>
                <!-- Filtros -->
            </div>
        </form>
        <table class="table table-striped" style="border: 1px solid black;text-align:center;">
            <thead class="table table-dark">
                <tr>
                    <th>Título</th>
                    <th>Páginas</th>
                    <th>Autor</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($fila = $resultado -> fetch_assoc()){
                ?>
                    <tr>
                        <td><?php echo $fila["titulo"] ?></td>
                        <td><?php echo $fila["paginas"] ?></td>
                        <td><?php echo $fila["autor"] ?></td>
                        <td>
                            <form action="view_book.php" method="get">
                                <input type="hidden" name="libro" value="<?php echo $fila["titulo"] ?>">
                                <input class="btn btn-outline-info" type="submit" name="boton" value="Ver">
                            </form>
                            
                            <form action="eliminarBook.php" method="post">
                                <input type="hidden" name="libro" value="<?php echo $fila["titulo"] ?>">
                                <input class="btn btn-outline-danger" type="submit" name="boton"value="Eliminar">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>