<?php 

require '../../site/verifica_login.php';
require '../../modelo/Cidade.php';

var_dump($_POST);
// $cidade = new Cidade();

// $idCidade = (isset($_POST['cidade'])) ? $_POST['cidade'] : null ;
// $idGrupo = (isset($_SESSION['idGrupo'])) ? $_SESSION['idGrupo'] : null ;

// $result = $cidade->cadastro($idCidade, $idGrupo);

// if($result['tipo']){
//     $_SESSION['mensagem']['tipo'] = 'success';
//     $_SESSION['mensagem']['content'] = $result['mensagem'];
// }else{
//     $_SESSION['mensagem']['tipo'] = 'danger';
//     $_SESSION['mensagem']['content'] = $result['mensagem'];
// }

// header('Location: /view/cidades.php');