<?php 

require_once 'Conexao.php';

class Cidade{

    public function retornaCidades($id_grupo){

        try {
            $PDO = Conexao::Connect();

            $query = $PDO->prepare('SELECT * FROM grupos, grupocidade, cidades WHERE grupocidade.id_grupo = :id_grupo and grupocidade.id_grupo = grupos.id_grupo and grupocidade.id_cidade = cidades.id_cidade');
            $query->execute([
                ':id_grupo' => $id_grupo
            ]);

            if($query->rowCount() > 0){
                
                 $result = $query->fetchAll();
                 $response = [];
                 $count = 0;

                 foreach ($result as $res) {
                     $response[$count]['id_grupo'] = $res['id_grupo'];
                     $response[$count]['id_cidades'] = $res['id_cidade'];
                     $response[$count]['estado'] = $res['estado'];
                     $response[$count]['uf'] = $res['uf'];
                     $response[$count]['capital'] = $res['capital'];

                     $count++;
                 }

                return $response;
            }else{
                return false;
            }

        } catch (PDOException $erro) {
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );
        }
    }



}