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

}