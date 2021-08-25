<?php 

require_once 'Conexao.php';

class Grupo{
    
 
    public function cadastro($grupo_nome, $id_usuario){
        

        try {

            $PDO = Conexao::Connect();
            if(!$this->verificaNome($grupo_nome, $id_usuario)){
                $query = $PDO->prepare('INSERT INTO grupos(grupo_nome, id_usuario) VALUES (:grupo_nome, :id_usuario)');
                $query->execute([
                    ':grupo_nome' => $grupo_nome,
                    ':id_usuario' => $id_usuario
                ]);

                if($query->rowCount() > 0){
                    $lastId = $PDO->lastInsertId();
                    return array(
                        'tipo' => 1,
                        'idGrupo_nome' => $lastId,
                        'mensagem2' => 'Grupo criado com sucesso.'
                    );
                }else{
                    return array(
                        'tipo' => 0,
                        'mensagem' => 'Cadastro do grupo falhou.'
                    );
                }
            }else{
                return array(
                    'tipo' => 0,
                    'mensagem' => 'Nome do grupo existente.'
                );
            }
            
        } catch (PDOException $erro) {
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );
            echo($erro);
        }

        
    }

    public function getGruposByUsuario($id_usuario){

        try {
            $PDO = Conexao::Connect();

            $query = $PDO->prepare('SELECT * FROM grupos WHERE id_usuario = :id_usuario ORDER BY id_grupo DESC');
            $query->execute([
                ':id_usuario' => $id_usuario
            ]);

            if($query->rowCount() > 0){
                $result = $query->fetchAll();
                $response = [];
                $count = 0;

                foreach ($result as $res) {
                    $response[$count]['id_usuario'] = $res['id_grupo'];
                    $response[$count]['grupo_nome'] = $res['grupo_nome'];
                    $response[$count]['id_grupo'] = $res['id_grupo'];

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

    public function deleta($id){

        try {

            $PDO = Conexao::Connect();

            $PDO->beginTransaction();

            // VERIFICA SE HÁ CIDADES CADASTRADAS NO GRUPO
            $queryCheckGHC = $PDO->prepare('SELECT * FROM grupocidade WHERE id_grupo = :id');
            $queryCheckGHC->execute([':id' => $id]);

            //CHECA CIDADES
            if($queryCheckGHC->rowCount() > 0){
                $queryghc = $PDO->prepare('DELETE FROM grupocidade WHERE id_grupo = :id');
                $queryghc->execute([':id' => $id]);

                if($queryghc->rowCount() > 0){
                    $check = true;
                }else{
                    $check = false;
                }
            }else{
                $check = true; 
            }

            if($check){
                $queryg = $PDO->prepare('DELETE FROM grupos WHERE id_grupo = :id');
                $queryg->execute([':id' => $id]);

                if ($queryg->rowCount() > 0) {
                    $PDO->commit();
                    return array(
                        'tipo' => 1,
                        'mensagem' => 'Grupo removido com sucesso.'
                    );
                }else{
                    $PDO->rollBack();
                    return array(
                        'tipo' => 0,
                        'mensagem' => 'Erro na exclusão.'
                    );
                }
            }else{
                $PDO->rollBack();
                return array(
                    'tipo' => 0,
                    'mensagem' => 'Erro na exclusão.'
                );
            }

        } catch (PDOException $erro) {
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );
        }
    }

    private function verificaNome($grupo_nome, $id_usuario){

        try {

            $PDO = Conexao::Connect();

            $query = $PDO->prepare('SELECT * FROM grupos WHERE grupo_nome = :grupo_nome AND id_usuario = :id_usuario');
            $query->execute([
                ':grupo_nome' => $grupo_nome,
                ':id_usuario' => $id_usuario
            ]);

            if($query->rowCount() > 0) {
                return true;
            }else{
                return false;
            }

        }catch (PDOException $erro) {
            return false;
        }
    }

    public function getGrupoByID($id_grupo){

        try {

            $PDO = Conexao::Connect();

            $query = $PDO->prepare("SELECT * FROM grupos WHERE id_grupo = '$id_grupo' ")->execute();
            // $query->execute([
            //     ':id_grupo' => $id_grupo
            // ]);

            if($query->rowCount() > 0) {
                $result = $query->fetch();

                $response['id_grupo'] = $result['id_grupo'];
                $response['grupo_nome'] = $result['grupo_nome'];

                return $response;
            }

        } catch (PDOException $erro) {
            return array(
                'tipo' => 0,
                'mensagem' => 'Erro no banco: ' . $erro->getMessage()
            );
        }
    }

}