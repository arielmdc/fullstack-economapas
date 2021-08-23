<?php

if(!isset($_GET['req'])){
    header('Location: /visao/dashboard.php');
}

$req = $_GET['req'];

switch ($req) {

    case 'getGruposByUsuario':
        require_once '../modelo/Grupo.php';
        session_start();
        $grupo = new Grupo();
        $result = $grupo->getGruposByUsuario($_SESSION['id_usuario']);
        echo json_encode($result);
        break;

    default:
        # code...
        break;
}