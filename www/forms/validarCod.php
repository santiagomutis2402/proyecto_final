<?php
ob_start();
require_once("../class/pelicula.php");
$obj_actividad = new pelicula();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require '../PHPMailer-master/src/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'f75afa7938cf97';
    $mail->Password = '4ef29f374d2b76';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('freemovie@gmail.com', 'Gerente');
    $mail->addAddress('andrezperez2402@gmail.com');

    // $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

    $mail->isHTML(true);
    $mail->Subject = 'Codigo de verificacion';
    $mail->Body = 'Hola, <br/>Su codigo de verificacion es: 2402 .';
    $mail->send();
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}

$correo = $_GET['correo'];
$username = $_GET['username'];
$pasword = $_GET['password'];

$rol = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    if ($codigo == 2402) {
        $consulta = $obj_actividad->registro($correo, $username, $pasword, $rol);
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <link rel="stylesheet" href="../styles/style.css" />

</head>

<body class="bg-fondo">
    <div class="m-0 vh-100 row justify-content-center align-items-center">
        <div class="col-auto bg-dark p-5 card shadow-lg p-3 mb-5 rounded w-25">
            <h1 class="text-center text-white ">Registro</h1>
            <form method="post" class="">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold  text-white">Ingresa el
                        codigo</label>
                    <input type="number" class="form-control bg-dark text-white" id="exampleFormControlInput1"
                        placeholder="####" name="codigo">
                </div>

                <p class="text-white fw-light">Ya tienes cuenta! <a href="/index.php" class="text-warning">Logeate</a>
                </p>


                <div class="d-grid gap-2 mb-3">
                    <button class="btn btn-outline-primary mb-3" type="submit">Registrarte</button>

                </div>
                <a href="/listar.php" class="text-white fw-lighter ">Volver</a>
            </form>
        </div>
    </div>
    <?php
    include '../templates/footer.php';