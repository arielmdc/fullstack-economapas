<?php

if(!isset($_GET['req'])){
    header('Location: /visao/dashboard.php');
}

$req = $_GET['req'];

switch ($req) {
    case 'cidades':
        require_once '../modelo/Cidade.php';
        $cidade = new Cidade();
        $id_grupo = $_POST['id_grupo'];
        $resp = $cidade->retornaCidades($id_grupo);
        echo json_encode($resp);
        break;
    case 'todasCidades':
        require_once '../modelo/Cidade.php';
        $cidade = new Cidade();
        //$id_grupo = $_POST['id_grupo'];
        $resp = $cidade->retornaTodasCidades();
        echo json_encode($resp);
        break;
    case 'getGrupos':
        require_once '../modelo/Grupo.php';
        session_start();
        $grupo = new Grupo();
        $result = $grupo->getGrupoByID($id_grupo);
        echo json_encode($result);
        break;

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