<?php

require_once '../../modelo/Usuario.php';

session_start();

$usuario = new Usuario();

$login = (!empty($_POST['login'])) ? $_POST['login'] : null;
$senha = (!empty($_POST['senha'])) ? $_POST['senha'] : null;

if (!is_null($login) && !is_null($senha)) {
    $exec = $usuario->logar($login, $senha);
    if ($exec['tipo']) {
        $_SESSION['id_usuario'] = $exec['data']['id_usuario'];
        $_SESSION['nome'] = ($exec['data']['nome']);
        header('Location: ../../visao/dashboard.php');
    }else{
        $_SESSION['danger']['content'] = 'Credenciais incorretas. Por favor, verifique-as e tente novamente.';
        header('Location: /index.php');
    }
}else{
    $_SESSION['alert']['content'] = 'Por favor, preencha todos os campos!';
    header('Location: ../../index.php');
}
