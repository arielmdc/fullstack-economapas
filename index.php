
<?php 

include 'site/inclusao.html'; 


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Economapas</title>
</head>
<body>
    <section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
            <img src="imagens/img_login01.jpg" class="img-fluid" alt="ferramenta">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <img src="imagens/img_login02.png" class="img-fluid" alt="logo">
            <form action="controle/usuario/login.php" method="post">
            <div class="form-outline mb-4">
              <input type="text" name="login" id="login" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example13">Login</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" name="senha" id="senha" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Senha</label>
            </div>
            <!-- alerta usuario existente -->
            <?php
            session_start();
            if(isset($_SESSION['danger'])){
                echo('
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.$_SESSION['danger']['content'].'
                </div>
            </div>
                ');
                unset($_SESSION['danger']);
            }
            ?>
            <!-- alerta verifica_login -->
            <?php
            session_start();
            if(isset($_SESSION['alert'])){
                echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.$_SESSION['alert']['content'].'
                </div>
              </div>
              
                ');
                unset($_SESSION['alert']);
            }
            ?>
            <center>
            <button type="submit" class="btn btn-primary btn-lg btn-block" value=>Entrar</button>
            </center>

            </form>
            </div>
            </div>
    </div>
    <?php include 'site/footer.html'; ?> 
    </section>
</body>

</html>