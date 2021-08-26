<?php 

require_once '../../site/verifica_login.php';
require_once '../../modelo/Cidade.php';

 $cidade = new Cidade();
//var_dump($_POST);
    // $id_cidade = (isset($_POST['id_cidade'])) ? $_POST['id_cidade'] : null ;
    // $id_grupo = (isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : null ;
    
    $id_grupo = $_POST['id_grupo'];;
    $id_cidade = $_POST['id_cidade'];
    var_dump($id_cidade);
    var_dump($id_grupo);
    $cidade->limpaCidade($id_grupo);
    foreach($id_cidade as $city){
        $result = $cidade->cadastro($id_grupo, $city);
    }
 
 
var_dump($result);  
if($result['tipo']){
    $_SESSION['mensagem']['content'] = $result['mensagem'];
 }else{
    $_SESSION['mensagem']['content'] = $result['mensagem'];
 }
 header('Location: /visao/dashboard.php');
 
 ?>