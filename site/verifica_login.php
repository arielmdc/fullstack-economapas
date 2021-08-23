<?php
// Inicia sessões
session_start();

// Verifica se existe os dados da sessão de login
if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome"]))
{
    $_SESSION['mensagem2']['content'] = 'Por favor, faça login para ter acesso a esta página.';
header("Location: ../index.php");

exit;
}
?>