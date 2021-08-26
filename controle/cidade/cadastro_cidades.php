<?php 

require_once '../../site/verifica_login.php';
require_once '../../modelo/Cidade.php';

$cidade = new Cidade();
$id_grupo = $_POST['id_grupo'];;
$id_cidade = $_POST['id_cidade'];
var_dump($id_cidade);
var_dump($id_grupo);
$cidade->limpaCidade($id_grupo);
foreach($id_cidade as $city){
    $result = $cidade->cadastro($id_grupo, $city);
}
if($result['tipo']){
    $_SESSION['success']['content'] = $result['mensagem'];
 }else{
    $_SESSION['success']['content'] = "Cidades do grupo alteradas com sucesso.";
 }
 header('Location: /visao/dashboard.php');
 
 ?>