<?php
require_once '../site/inclusao.html';
require_once '../site/verifica_login.php';
include '../site/navbar.php';

?>
<link rel="stylesheet" href="../css/dashboard.css">

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Economapas</title>
</head>
<body>
<div class="container py-5 h-100">
    <center>
    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
    <form action="../controle/grupo/criar_grupo.php" method="post"> 
    <div class="mb-3">
        <h3>Criar novo grupo</h3>
        
        <input type="text" class="form-control" name="grupo_nome" id="grupo_nome" placeholder="Digite o nome do grupo...">
    </div>
    <button type="submit" value="Enviar" class="btn btn-primary">Criar</button>
    </form>
    </div>
    </center>
    <?php
            session_start();
            if(isset($_SESSION['mensagem'])){
                echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.$_SESSION['mensagem']['content'].'
                </div>
            </div>
                ');
                unset($_SESSION['mensagem']);
            }

            if(isset($_SESSION['mensagem2'])){
                echo('
                <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.$_SESSION['mensagem2']['content'].'
                </div>
                </div>
                ');
                unset($_SESSION['mensagem2']);
            }
            ?>
            
            <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo_modal"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
            
    
    <hr class="bg-dark border-2 border-top border-dark">

    <div class="container">
        <div class="row" id="card_grupos">
        <!-- <div class="col-lg-4">
        <div class="card card-margin">
            <div class="card-header no-border">
                <h5 class="card-title">MOM</h5>
            </div>
            <div class="card-body pt-0">
                <div class="widget-49">
                    <div class="widget-49-title-wrapper">
                        <div class="widget-49-date-primary">
                            <span class="widget-49-date-day">09</span>
                            <span class="widget-49-date-month">apr</span>
                        </div>
                        <div class="widget-49-meeting-info">
                            <span class="widget-49-pro-title">PRO-08235 DeskOpe. Website</span>
                            <span class="widget-49-meeting-time">12:00 to 13.30 Hrs</span>
                        </div>        
                    </div>
                    <ol class="widget-49-meeting-points">
                        <li class="widget-49-meeting-item"><span>Expand module is removed</span></li>
                        <li class="widget-49-meeting-item"><span>Data migration is in scope</span></li>
                        <li class="widget-49-meeting-item"><span>Session timeout increase to 30 minutes</span></li>
                    </ol>
                    <div class="widget-49-meeting-action">
                        <a href="#" class="btn btn-sm btn-flash-border-primary">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


</div>
</div>
<?php include '../site/footer.html'; ?> 
</body>

</hmtl>

<script>
$(document).ready(() => {

    console.log("teste");
    $.ajax({
        type: "GET",
        url: "../rotas/data.php?req=getGruposByUsuario",
        success: function (response) {
            var data = JSON.parse(response);
            if (data) {
        console.log(data);
        $.each( data, (key, val) => { 
                $('#card_grupos').append(`
                <div class="col-lg-4">
                    <div class="card card-margin">
                        <div class="card-header no-border">
                            <h5 class="card-title">Grupo:
                             ${val.grupo_nome}
                             </h5>
                        </div>
                        <div class="card-body pt-0">

                        </div>
                        <ol class="widget-49-meeting-points">
                            <li class="widget-49-meeting-item">
                                <span>Expand module is removed</span>
                            </li>
                            <li class="widget-49-meeting-item">
                                <span>Data migration is in scope</span>
                            </li>
                            <li class="widget-49-meeting-item">
                                <span>Session timeout increase to 30 minutes</span>
                            </li>
                            </ol>
                            <div class="div-flex-buttons">
                        <button id="button" value="${val.id_grupo}" type="button" class="btn btn-primary button-perf" data-bs-toggle="modal" data-bs-target="#exampleModal">Visualizar

                         </button>

                         <form action="../controle/grupo/excluir.php" method="post">
                            <input type="hidden" name="id" value="${val.id_grupo}">
                            <button type="submit" class="btn btn-danger button-perf">Excluir
                            </button>
                        </form>
                    </div>
                 
                 
                
                  </div>
                  </div>
                  </div>
                  </div>`);
                
            });   
            $(button).on("click", function(e) {
                $('#modalBody').empty();
                // $.getJSON( "../rotas/data.php?req=getGrupos", ( data ) => {
                //                 console.log(data);
                //     });
                    $.ajax({
                        type: "POST",
                        url: "../controle/grupo/listar_dados_grupo.php",
                        data: {
                            id: $(this).val()
                        },
                        success: function (response) {
                            console.log(response);
                            $('#modalBody').append(response);
                        }
                    });
                   //$('#modalTitulo').empty()
                   //$('#modalFooter').empty()
              // e.preventDefault();//$('#grupos').append(val.grupo_nome);
           //$('#modalBody').append("<div class='col-md-10'><b>Contato: </b>"+val.grupo_nome+"</div>")
           //consulta de buscar cidades e exbiciçao na modal
            });
                
       }else{
           $('#titulo-tabela').remove();
           $('#card_grupos').append('<span class="pl-2">Você não tem grupos cadastrados.</span>'); 
           
           
       }
        }
    });
    // $.getJSON( "../rotas/data.php?req=getGruposByUsuario", ( data ) => {
       
    // });
    
});
</script>

