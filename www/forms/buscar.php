<?php
include '../templates/header2.php';
require_once("../class/pelicula.php");

$obj_actividad = new pelicula();

$auth = $obj_actividad->validar();
if (!$auth) {
    header('Location: /');
}

$titulo = "";
$npeliculas = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $peliculas =  $obj_actividad->Buscar_Peli($titulo);
    $npeliculas = count($peliculas);


    // echo "<pre>";
    // var_dump($npeliculas);
    // echo "<\pre>";
}


?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <label class="form-label fw-bolder fs-1 text-primary">Ingrese la Pelicula 🔥</label>
            <form action="buscar.php" method="POST">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $titulo ?>" name="titulo"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-warning" type="submit" id="button-addon2">🔍</button>
                </div>
            </form>
        </div>

        <?php if ($npeliculas > 0) : ?>
        <?php foreach ($peliculas as $r) : ?>
        <div class="col-12 col-md-3 mb-3 ">
            <a href="/forms/detalles.php?id=<?php echo $r['id'] ?>">
                <div class="card tm " style="background-image:url('../<?php echo $r['portada']; ?>') ;">
                    <div class="overlay">
                        <div class="text">
                            <p><?php echo $r['titulo']; ?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>


<?php
include '../templates/footer.php';