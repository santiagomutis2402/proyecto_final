<?php
require_once("../class/pelicula.php");
$obj_actividad = new pelicula();

$ID = $_GET['id'];
$VIDEO = $_GET['video'];
$portada = $_GET['portada'];

$obj_actividad->eliminar($ID, $VIDEO, $portada);