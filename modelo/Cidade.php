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


    public function retornaTodasCidades(){

        try {
            $PDO = Conexao::Connect();

            $query =
            $query = $PDO->prepare('SELECT * FROM cidades ORDER BY estado ASC');
            $query->execute();

            if($query->rowCount() > 0){
                $result = $query->fetchAll();
                $response = [];
                $count = 0;

                foreach ($result as $res) {
                    $response[$count]['id_cidade'] = $res['id_cidade'];
                    $response[$count]['cidades'] = $res['capital'] . ' - ' . $res['uf'];
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

    public function desativaCidade($id_grupo, $id_cidade){

        try {

            $PDO = Conexao::Connect();

            $query = $PDO->prepare('SELECT * FROM grupocidade WHERE id_grupo = :id_grupo AND id_cidade = :id_cidade ');
            $query->execute([
                ':id_grupo' => $id_grupo,
                ':id_cidade' => $id_cidade
            ]);

            if($query->rowCount() > 0){
                $result = $query->fetchAll();
                $response = [];
                $count = 0;

                foreach ($result as $res) {
                    $response[$count]['id_grupo'] = $res['id_grupo'];
                    $response[$count]['id_cidade'] = $res['id_cidade'];
                    
                    $count++;
                }

                return $response;
            }else{
                return false;
            }


        }catch(PDOException $erro){
            return false;
        }
    }

    public function cadastro($id_grupo, $id_cidade){
        
        try {  
            $PDO = Conexao::Connect();
            $query = $PDO->prepare("INSERT INTO grupocidade(id_grupo, id_cidade) VALUES ('$id_grupo', '$id_cidade')");
            $query->execute();
            if($query->rowCount() > 0){
                return array(
                    'tipo' => 1,
                    'mensagem' => 'Cidades adicionada.'
                );
            }else{
                return array(
                    'tipo' => 0,
                    'mensagem' => 'Erro no cadastro.'
                );
            }

        } catch (PDOException $erro) {
            var_dump($erro);
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );

        }
        var_dump($query);

    }

    public function limpaCidade($id_grupo){
        try {

            $PDO = Conexao::Connect();
            $query = $PDO->prepare("DELETE FROM grupocidade WHERE id_grupo = '$id_grupo'");
            $query->execute();

        } catch (PDOException $erro) {
            var_dump($erro);
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );

        }
    }


    

    



}