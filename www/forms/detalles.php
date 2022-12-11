<?php
require_once("../class/pelicula.php");

$ID = $_GET['id'];
$obj_pelicula = new pelicula();

$obj_pelicula->iniciar_Server();
$auth = $obj_pelicula->validar();
if (!$auth) {
    header('Location: /');
}

$detalles = $obj_pelicula->listar_peliculas_ID($ID);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="/styles/style.css">
</head>

<body class="tmc2 "
    style="background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 2)), url('../<?php echo $detalles['portada'] ?>') ;">

    <div class="container ">
        <div class="row">
            <div class="col-12 ">
                <h1 class="text-start text-white mb-3 mt-5"><?php echo $detalles['titulo'] ?></h1>
                <div class="d-flex justify-content-center">
                    <video controls width="100%" height="40%" src="../<?php echo $detalles['video'] ?>"></video>
                </div>
            </div>

            <div class="col-12 col-md-7 mt-3 text-white">
                <p><?php echo $detalles['descripcion'] ?></p>
            </div>
            <div class="col-12 col-md-5 mt-3">
                <div class="d-grid gap-2">
                    <a href="eliminar.php?id=<?php echo $ID; ?>&video=<?php echo $detalles['video'] ?>&portada=<?php echo $detalles['portada']  ?>"
                        class="btn btn-outline-danger mb-2">Eliminar</a>
                    <a href="/forms/crear_editar.php?id=<?php echo $detalles['id']; ?>"
                        class="btn btn-outline-warning  mb-2">Editar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>