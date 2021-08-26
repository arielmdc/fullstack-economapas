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
    <!-- Inicio body -->
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
        //ALERTAS DE MENSAGENS
            session_start();
            if(isset($_SESSION['alerta'])){
                echo('
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                '.$_SESSION['alerta']['content'].'
                </div>
            </div>
                ');
                unset($_SESSION['alerta']);
            }

            if(isset($_SESSION['success'])){
                echo('
                <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                '.$_SESSION['success']['content'].'
                </div>
                </div>
                ');
                unset($_SESSION['success']);
            }

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
      </div>
    </div>
  </div>
</div>
    <hr class="bg-dark border-2 border-top border-dark">
    <div class="container">
        <div class="row" id="card_grupos">

        </div>
    </div>
</div>

<!-- inclusão rodapé -->
<?php include '../site/footer.html'; ?> 
<!-- Fim body --> 
</body>

</hmtl>

<!-- Inicio script -->
<script>
//função bloquear botão salvar

// function verifySaveButton(){

// if($("#ol_cidades_modal li").length <= 0) {
//     $("#salvar-cidade").prop("disabled", true)
    
// }else{
//     $("#salvar-cidade").prop("disabled", false)
// } 
// }

//Função deletar uma cidade selecionada da lista

function deleteCityInList(id_cidades){
    
    $(`.item_${id_cidades}`).remove()
    $("#seletor-cidade option[value=" + id_cidades + "]").attr("disabled", false);
    $("#seletor-cidade option[value=" + id_cidades + "]").prop("selected", true);
    verifyAddButton()
    // verifySaveButton()
    verifyEmptyList()
}

//Função de verificação de lista vazia

function verifyEmptyList(){
    if($('#ol_cidades_modal li').length){
        $('#aviso-vazio').remove();
    }else{
        $('#ol_cidades_modal').after('<span id="aviso-vazio">Não há cidades cadastradas</span>');
    }
}

//Função de preenchimento do select com os options vindo do banco de dados

function preencheOptionCity(){
    $.ajax({
        type: "GET",
        url: "../rotas/data.php?req=todasCidades",
        success: function (response) {
            var data2 = JSON.parse(response);
            var html2='';
            $.each(data2, function (indexInArray, element) { 
                    html2 += `<option value="${element.id_cidade}">${element.cidades}</option>`;
                });
                $(`#seletor-cidade`).append(`${html2}`);
               
        }
    });
}

//Função que desabilita a seleção de cidades ja selecionadas

function disableCity(id_grupo,id_cidade){
    $.ajax({
        type: "POST",
        url: "../rotas/data.php?req=desativarCidades",
        data: { 
            id_grupo: id_grupo,
            id_cidade: id_cidade,
         },
        success: function (response) {
            var data2 = JSON.parse(response);
            $.each(data2, function (indexInArray, element) { 
                $("#seletor-cidade option[value=" + element.id_cidade + "]").attr("disabled", true);
                $("#seletor-cidade option[value=" + element.id_cidade + "]").prop("selected", false);
            });
        }
    });
}

//Função do click da janela modal "Visualizar"

function getClick(){
    $(".button-visualizar").click(function(e) {
        verifyAddButton()
        var id_grupo = $(this).val()
        $('#modalBody').empty(); 
        $.ajax({
            type: "POST",
            url: "../rotas/data.php?req=cidades",
            data: { id_grupo: id_grupo },
            success: function (response) {
                preencheOptionCity();
                var data2 = JSON.parse(response);
                var html='';
                if(!data2){
                     html='<span id="aviso-vazio">Não há cidades cadastradas</span>';
                }else{

                    $.each(data2, function (indexInArray, element) { 
                        disableCity(element.id_grupo,element.id_cidades);
                        html += ` <div><li  class=" li_item widget-49-meeting-item item_${element.id_cidades}"> <input type="hidden" name="id_cidade[]" value="${element.id_cidades}" /> ${element.capital} - ${element.uf} <button class="btn btn-outline-danger" onclick="deleteCityInList('${element.id_cidades}')">X</button></li></div>`;
                    });
                }
                $('#modalBody').append(`<form action="../controle/cidade/cadastro_cidades.php" method="post" style="margin: 0">
                                                <input type="hidden" name="id_grupo" value="${id_grupo}" />
                                               <div class="row">
                                                    <div class="col-sm-10">
                                                        <select id="seletor-cidade" class="form-control w-100 mb-3">
                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-primary" id="adicionar-cidade" onclick="addCity()">+</button>
                                                    </div>
                                               </div>
                                                <ol class="widget-49-meeting-points" id="ol_cidades_modal">${html}</ol>

                                                <button type="submit" id="salvar-cidade" class="btn btn-primary btn-block w-100 mt-3"> Salvar cidades </button>
                                            </form>`);
                                            // verifySaveButton()
                                            verifyAddButton()
                                            
            }
        });
    });
}

//Função para setar no card as cidades já cadastradas em um grupo existente

function setCities(id_grupo){
    $.ajax({
        type: "POST",
        url: "../rotas/data.php?req=cidades",
        data: { id_grupo: id_grupo },
        success: function (response) {
            var data2 = JSON.parse(response);
            var html='';
            if(!data2){
                $(`#${id_grupo}`).append(`<span>Não há cidades cadastradas</span>`);
            }else{
                $.each(data2, function (indexInArray, element) { 
                    html += `<li class="widget-49-meeting-item">${element.capital} - ${element.uf} </li>`;
                });
                $(`#${id_grupo}`).append(`<ol class="widget-49-meeting-points" id="ol_cidades">${html}</ol>`);
            }
        }
    });
}

//Função de adição da cidade selecionada na lista

function addCity(){
    
    $("#salvar-cidade").prop("disabled", false)
    event.preventDefault();
    var id_cidade = $("#seletor-cidade").val()
    var cidade = $("#seletor-cidade option[value="+id_cidade+"]").text();
    $("#ol_cidades_modal").append(`<li class=" li_item widget-49-meeting-item item_${id_cidade}"> <input type="hidden" name="id_cidade[]" value="${id_cidade}" /> ${cidade} <button class="btn btn-outline-danger" onclick="deleteCityInList('${id_cidade}')">X</button></li>`)
    $("#seletor-cidade option:selected").attr('disabled', true);
    $('#seletor-cidade option:selected').prop("selected", false);
    verifyAddButton()
    verifyEmptyList()
}

//Função desabilitar o botão de adição de cidades já exista 5 cidades no grupo

function verifyAddButton(){
    if($("#ol_cidades_modal li").length >= 5) {
        $("#adicionar-cidade").prop("disabled", true)
    }else{
        $("#adicionar-cidade").prop("disabled", false)
    } 

}

//Inicio documento ready

$(document).ready(function(){

    $.ajax({
        type: "GET",
        url: "../rotas/data.php?req=getGruposByUsuario",
        success: function (response) {
            var data = JSON.parse(response);
            
            if (data) {
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
                $('#card_grupos').append('<span class="pl-2">Você não tem grupos cadastrados.</span>');     
            }
        }
    }); 
});

</script>


