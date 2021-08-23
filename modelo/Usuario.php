<?php 

require_once 'Conexao.php';

class Usuario{

    public function logar($login, $senha){   

        try {
            $pdo = Conexao::Connect();
            $query = $pdo->prepare("SELECT id_usuario, nome FROM usuarios WHERE login = :login AND senha = :senha");
            $query->execute([
                ':login' => $login,
                ':senha' => $senha
            ]);
            if($query->rowCount() > 0){
                return array(
                    'tipo' => 1,
                    'data' => $query->fetch()
                );
            }else{  
                return array(
                    'tipo' => 0,
                    'mensagem' => 'usuario não encontrado'
                );
            }
        } catch (PDOException $erro) {
            return array(
                'tipo' => 0,
                'mensagem' => $erro->getMessage()
            );
        }
    }
}