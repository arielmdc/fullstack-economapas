
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
            <form>
             <!-- login input -->
            <div class="form-outline mb-4">
              <input type="text" name="login" id="login" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example13">Login</label>
            </div>
            <!-- senha input -->
            <div class="form-outline mb-4">
                <input type="password" name="senha" id="senha" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example23">Senha</label>
            </div>
            <!-- Submit button -->
            <center>
            <button type="submit" class="btn btn-primary btn-lg btn-block" >Entrar</button>
            </center>

            </form>
            </div>
            </div>
    </div>
    </section>
</body>
</html>