<?php
ob_start();
include '../templates/header2.php';

$id = $_GET['id'] ?? 0;

$obj_actividad = new pelicula();

$auth = $obj_actividad->validar();
if (!$auth) {
    header('Location: /');
}

$obj_pelicula = new pelicula();
$obj_insertar = new pelicula();
$generos = $obj_actividad->ListarGeneros();
$peliculas = $obj_pelicula->listar_peliculas_ID($id);

$titulo = $peliculas['titulo'] ?? null;
$titulo2 = $titulo;
$descripcion = $peliculas['descripcion'] ?? null;
$genero = $peliculas['generoid'] ?? null;
$portadadb = $peliculas['portada'] ?? null;
$videodb = $peliculas['video'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id =  $_GET['id'] ?? 0;
    $titulo = $_POST['titulo'];
    $genero = $_POST['genero'];
    $descripcion = $_POST['descripcion'];
    $portada = $_FILES['imagen'] ?? null;
    $video = $_FILES['video'] ?? null;



    if ($id == 0) {
        $carpetaimagenes = $obj_pelicula->crearcarpeta($titulo);
        $rutaImagen = $obj_pelicula->moverarchivo($portada, $carpetaimagenes, $titulo);
        $rutaVideo = $obj_pelicula->moverarchivo($video, $carpetaimagenes, $titulo);
        $response =  $obj_insertar->InsertarPelicula($titulo, $descripcion, $rutaImagen, $rutaVideo, $genero);
    } else {

        if ($portada['name'] != "") {
            $rutaImagen = "../" . $portadadb;
            unlink($rutaImagen);
        }

        if ($video['name'] != "") {
            $rutaVideo = "../" . $videodb;
            unlink($rutaVideo);
        }


        $carpetaimagenes = $obj_pelicula->crearcarpeta($titulo);
        $tam = strlen($carpetaimagenes);
        $carpetaRuta2 =  substr("${carpetaimagenes}", 3, $tam);

        $rutaImagen = $obj_pelicula->moverarchivo($portada, $carpetaimagenes, $titulo);
        $rutaVideo = $obj_pelicula->moverarchivo($video, $carpetaimagenes, $titulo);

        //verificar esto aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

        if ($rutaImagen == "${carpetaRuta2}") {
            $rutaImagen = $portadadb;
        }
        if ($rutaVideo == "${carpetaRuta2}") {
            $rutaVideo = $videodb;
        }
        if ($rutaVideo == "${carpetaRuta2}" && $rutaImagen == "${carpetaRuta2}") {
            $rutaVideo = $videodb;
            $rutaImagen = $portadadb;
        }
        $response = $obj_insertar->EditarPelicula($titulo, $descripcion, $rutaImagen, $rutaVideo, $genero, $id);
    }

    if ($response) {
        header('Location: /listar.php');
    }
}
$ngeneros = count($generos);
ob_end_flush();
?>
<div class="container ">
    <div class="row">
        <div class="col-12 col-md-6 d-flex align-items-center">
            <div class="cuerpo w-100 me-5 ms-5">
                <?php if ($id > 0) : ?>
                <h1>Editar</h1>
                <?php else : ?>
                <h1>Crear</h1>
                <?php endif; ?>

                <form class="needs-validation" action="crear_editar.php?id=<?php echo $id; ?>" method="POST"
                    enctype="multipart/form-data">
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label">Titulo</label>
                        <input type="text" name="titulo" value="<?php echo $titulo ?>" class="form-control"
                            placeholder="Avengers" required>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Genero</label>
                        <select class="form-select" name="genero" aria-label="Default select example" required>
                            <?php if ($ngeneros > 0) : ?>
                            <?php foreach ($generos as $resultado) : ?>
                            <option <?php echo $genero === $resultado['id'] ? 'selected' : '' ?>
                                value="<?php print $resultado['id'] ?>"><?php echo $resultado['genero'] ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"
                            required><?php echo $descripcion ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Portada</label>
                        <input type="file" accept="img" class="form-control" name="imagen" id="imagen"
                            <?php if ($id == 0) { ?> required <?php } else { ?> <?php } ?>>
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label">Video</label>
                        <input type="file" class="form-control" name="video" id="video" <?php if ($id == 0) { ?>
                            required <?php } else { ?> <?php } ?>>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Subir">
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 ">
            <div class="fondoform"></div>
        </div>
    </div>
</div>
<?php
include '../templates/footer.php';