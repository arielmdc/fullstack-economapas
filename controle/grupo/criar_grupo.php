<?php 

require_once '../../site/verifica_login.php';
require_once '../../modelo/Grupo.php';

$grupo = new Grupo();

$id_usuario = (isset($_SESSION['id_usuario'])) ? $_SESSION['id_usuario'] : null ;
$grupo_nome = (isset($_POST['grupo_nome'])) ? $_POST['grupo_nome'] : null ;

$result = $grupo->cadastro($grupo_nome, $id_usuario);

if($result['tipo']){
    $_SESSION['idGrupo_nome'] = $result['idGrupo_nome'];
    header('Location: /visao/dashboard.php');
    $_SESSION['mensagem2']['content'] = $result['mensagem2'];
}else{
    $_SESSION['mensagem']['content'] = $result['mensagem'];
    header('Location: /visao/dashboard.php');
}
