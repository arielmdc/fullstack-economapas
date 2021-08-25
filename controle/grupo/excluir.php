<?php 

require '../../site/verifica_login.php';
require '../../modelo/Grupo.php';

var_dump($_POST);


$grupo = new Grupo();

$idGrupo = ($_POST['id']); 

$result = $grupo->deleta($idGrupo);

if($result['tipo']){
    $_SESSION['mensagem2']['content'] = $result['mensagem'];
}else{
    $_SESSION['mensagem2']['content'] = $result['mensagem'];
}

header('Location: /visao/dashboard.php');
//header('Location: /visao/dashboard.php');