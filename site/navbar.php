<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../imagens/img_login02.png" alt="" class="d-inline-block align-text-top">
      </a>
      <label><strong>Usuário: </strong> <?php echo($_SESSION['nome']); ?></label>
      <a href="/controle/usuario/sair.php" class="btn btn-outline-primary" type="submit">Sair</a>

    </div>
  </nav>