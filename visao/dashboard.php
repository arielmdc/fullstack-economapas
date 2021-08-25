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

            if(isset($_SESSION['mensagem3'])){
                echo('
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.$_SESSION['mensagem3']['content'].'
                </div>
                </div>

                ');
                unset($_SESSION['mensagem3']);
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
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
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

function deleteCityInList(id_cidades){
    $(`.item_${id_cidades}`).remove()

    verifyAddButton()
}

function getClick(){
    $(".button-visualizar").click(function(e) {
        $('#modalBody').empty();

        console.log($(this).val());
        
        $.ajax({
            type: "POST",
            url: "../rotas/data.php?req=cidades",
            data: { id_grupo: $(this).val() },
            success: function (response) {
                var data2 = JSON.parse(response);
                var html='';
                if(!data2){
                    $('#modalBody').append(`<span>Não há cidades cadastradas</span>`);
                }else{
                    $.each(data2, function (indexInArray, element) { 
                        // console.log(element);
                        html += `<li class="widget-49-meeting-item item_${element.id_cidades}"> <input type="hidden" value="${element.id_cidades}" /> ${element.capital} - ${element.uf} <button class="btn btn-outline-danger" onclick="deleteCityInList('${element.id_cidades}')">X</button></li>`;
                    });
                    $('#modalBody').append(`<form action="../controle/grupo/xxx.php" method="post" style="margin: 0">
                                               <div class="row">
                                                    <div class="col-sm-10">
                                                        <select id="seletor-cidade" class="form-control w-100 mb-3">
                                                                <option value="10">Rio de Janeiro - RJ</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-primary" id="adicionar-cidade" onclick="addCity()">+</button>
                                                    </div>
                                               </div>

                                                <ol class="widget-49-meeting-points" id="ol_cidades_modal">${html}</ol>

                                                <button type="submit" class="btn btn-primary btn-block w-100 mt-3"> Salvar cidades </button>
                                            </form>`);
                }
            }
        });
    });
}

function setCities(id_grupo){
    $.ajax({
        type: "POST",
        url: "../rotas/data.php?req=cidades",
        data: { id_grupo: id_grupo },
        success: function (response) {
            var data2 = JSON.parse(response);
            
            // console.log(data2);
            var html='';
            if(!data2){
                $(`#${id_grupo}`).append(`<span>Não há cidades cadastradas</span>`);
            }else{
                $.each(data2, function (indexInArray, element) { 
                    //console.log(element);
                    html += `<li class="widget-49-meeting-item">${element.capital} - ${element.uf} </li>`;
                });
                $(`#${id_grupo}`).append(`<ol class="widget-49-meeting-points" id="ol_cidades">${html}</ol>`);
            }
        }
    });
}

function addCity(){
    event.preventDefault();

    var id_cidade = $("#seletor-cidade").val()
    var cidade = $("#seletor-cidade").text()

    console.log(cidade);

    $("#ol_cidades_modal").append(`<li class="widget-49-meeting-item item_${id_cidade}"> <input type="hidden" value="${id_cidade}" /> ${cidade} <button class="btn btn-outline-danger" onclick="deleteCityInList('${id_cidade}')">X</button></li>`)

    verifyAddButton()
}

function verifyAddButton(){
    if($("#ol_cidades_modal li").length >= 5) $("#adicionar-cidade").prop("disabled", true)
    else $("#adicionar-cidade").prop("disabled", false)
}

$(document).ready(function(){
    
    $.ajax({
        type: "GET",
        url: "../rotas/data.php?req=getGruposByUsuario",
        success: function (response) {
            var data = JSON.parse(response);
            
            if (data) {
                //console.log(data);
                $.each( data, (key, val) => { 
                    
                    $('#card_grupos').append(`
                            <div class="col-lg-4 grade">
                                <div class="card card-margin card_individual">
                                    <div class="card-header no-border">
                                        <h5 class="card-title">Grupo:
                                        ${val.grupo_nome}
                                        </h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div id="${val.id_grupo}">
                                    <ol class="widget-49-meeting-points id="ol_cidades">
                                                                    
                                        </ol>
                                    </div>
                                    </div>
                                    
                                        <div class="div-flex-buttons">
                                    <button value="${val.id_grupo}" type="button" class="btn btn-primary button-perf button-visualizar" data-bs-toggle="modal" data-bs-target="#exampleModal">Visualizar

                                    </button>

                                    <form action="../controle/grupo/excluir.php" method="post">
                                        <input type="hidden" name="id" value="${val.id_grupo}">
                                        <button type="submit" class="btn btn-danger button-perf">Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>`);

                    setCities(val.id_grupo);            
                });

                getClick() 
                         
            }else{
                $('#titulo-tabela').remove();
                $('#card_grupos').append('<span class="pl-2">Você não tem grupos cadastrados.</span>');     
            }
        }
    }); 
});

</script>


