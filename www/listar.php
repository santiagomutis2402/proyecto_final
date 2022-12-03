<?php

ob_start();
include 'templates/header.php';
require_once("class/pelicula.php");





$auth = $obj_actividad->validar();
if (!$auth) {
    header('Location: /');
}

$peliculas = $obj_actividad->listar_peliculas_principal();

$obj_pelicula2 = new pelicula();
$peliculas2 = $obj_pelicula2->listar_peliculas();


$npeliculas = count($peliculas);
$npeliculas2 = count($peliculas2);
ob_end_flush();
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 mb-3">
            <div class="card bg-primary shadow">
                <div class="card-body">
                    <h1 class="text-white">Invita <br> A Tus Amigos 🔥</h1>
                    <p class="card-text text-white">Vive la ultima experiencia de streaming de peliculas del mercado,
                        con un gran catalogo y con grandes exlusivos como One Punch Man Temporada 2</p>
                    <div class="input-group mb-3">
                        <!-- <input type="text" class="form-control" value="http://proyectof.test/"
                            aria-label="Recipient's username" aria-describedby="button-addon2"> -->
                        <h1 class="text-warning fs-3">😱 <span>http://proyectof.test</span> </h1>

                    </div>
                </div>
            </div>
        </div>

        <!-- carrousel -->
        <div class="col-12 col-md-8 ">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <?php if ($npeliculas > 0) : ?>
                    <?php foreach ($peliculas as $resultado) : ?>
                    <div class="carousel-item active">
                        <div class="card tmc "
                            style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo $resultado['portada'] ?>') ;">
                        </div>
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?php echo $resultado['titulo'] ?></h5>
                            <p><?php echo $resultado['descripcion'] ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12 mb-3">
                <h1>Peliculas 📽️</h1>
            </div>
            <?php if ($npeliculas2 > 0) : ?>
            <?php foreach ($peliculas2 as $resultado2) : ?>
            <div class="col-12 col-md-3 mb-3 ">
                <a href="forms/detalles.php?id=<?php echo $resultado2['id'] ?>">
                    <div class="card tm " style="background-image:url('<?php echo $resultado2['portada']; ?>') ;">
                        <div class="overlay">
                            <div class="text">
                                <p><?php echo $resultado2['titulo']; ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <div class="d-grid gap-2">
                <a href="forms/crear_editar.php" class="btn btn-primary mb-3">Insertar Pelicula</a>
            </div>
        </div>
    </div>
    <?php include 'templates/footer.php' ?>