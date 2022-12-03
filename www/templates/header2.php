<?php
require_once("../class/pelicula.php");
$obj_actividad = new pelicula();
$obj_actividad->iniciar_Server();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Listado</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="../styles/style.css" />
</head>

<body class="fondo">
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
            <div class="col-md-6">
                <ul class="nav col-12 col-md-auto mb-2 justify-content-start mb-md-0">
                    <li>
                        <a href="../listar.php" class="navbar-brand fw-bold fs-4">FreeMovie</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-6">
                <ul class="nav col-12 col-md-auto mb-2 justify-content-end mb-md-0">
                    <li><a href="/forms/buscar.php" class="nav-link px-2 link-dark fw-bold">Buscar</a></li>

                    <dialog id="dialogo" class="bg-white">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class="fw-semibold">Mi Perfil 😎</h1>
                                    <img src="/img_fondo/icono.jpg" class="img-fluid rounded mx-auto d-block icono mt-5"
                                        alt="">
                                    <div class="mt-3">
                                        <?php ?>
                                        <h3>Usuario: <?php echo $_SESSION['usuario']  ?></h3>
                                        <h3>Correo: <?php echo $_SESSION['correo'] ?> </h3>
                                    </div>
                                    <button id="cerrar" class="mt-3">Cerrar</button>
                                </div>
                            </div>
                        </div>

                    </dialog>
                    <button id="mostrar" class="navbar-brand fw-bold fs-5">Perfil</button>
                    <!-- <li><a href="/forms/buscar.php" class="nav-link px-2 link-dark fw-bold">Perfil</a></li> -->
                </ul>
            </div>
        </header>
    </div>