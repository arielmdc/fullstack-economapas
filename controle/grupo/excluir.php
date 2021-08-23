<?php 

require '../../core/verificaLogin.php';
require '../../model/Grupo.php';

$grupo = new Grupo();

$idGrupo = (isset($_POST['id'])) ? $_POST['id'] : null ; 

$result = $grupo->deleta($idGrupo);

if($result['tipo']){
    $_SESSION['mensagem']['tipo'] = 'danger';
    $_SESSION['mensagem']['content'] = $result['mensagem'];
}else{
    $_SESSION['mensagem']['tipo'] = 'warning';
    $_SESSION['mensagem']['content'] = $result['mensagem'];
}

header('Location: /view/dashboard.php');