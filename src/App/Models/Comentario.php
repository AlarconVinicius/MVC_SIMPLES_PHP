<?php

class Comentario 
{
    public static function selectComents($id_post) {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM comentario WHERE id_post = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id_post, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        
        while ($row = $stmt->fetchObject('Comentario')) {
            $result[] = $row;
        }
        return $result;
    }

    public static function insert($params)
    {
        if(empty($params['nome']) || empty($params['msg'])) {
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $con = Connection::getConn();

        $sql = "INSERT INTO comentario (id_post, nome, mensagem) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $params['id']);
        $stmt->bindValue(2, $params['msg']);
        $stmt->bindValue(3, $params['nome']);
        $result = $stmt->execute();

        if($result == 0) {
            throw new Exception("Falha ao inserir publicação!");
            return false;
        }
        return true;
    }
    
}