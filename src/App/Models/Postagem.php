<?php

class Postagem 
{
    public static function selectAll() {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = array();
        while ($row = $stmt->fetchObject('Postagem')) {
            $result[] = $row;
        }
        if(!$result) {
            throw new Exception("Não foi encontrado nenhum registro no banco.");
        }
        return $result;
    }
    public static function selectOneById($id) {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchObject('Postagem');
        if(!$result) {
            throw new Exception("Não foi encontrado nenhum registro no banco.");
        } else {
            $result->comentarios = Comentario::selectComents($result->id);
        }
        return $result;
    }

    public static function insert($dadosPost) 
    {
        if(empty($dadosPost['titulo']) || empty($dadosPost['conteudo'])) {
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $con = Connection::getConn();

        $sql = "INSERT INTO posts (titulo, conteudo) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $dadosPost['titulo']);
        $stmt->bindValue(2, $dadosPost['conteudo']);
        $result = $stmt->execute();
        var_dump($result);
        if($result == 0) {
            throw new Exception("Falha ao inserir publicação!");
            return false;
        }
        return true;
    }
    public static function update($params) 
    {
        if(empty($params['titulo']) || empty($params['conteudo'])) {
            throw new Exception("Preencha todos os campos!");
            return false;
        }

        $con = Connection::getConn();

        $sql = "UPDATE posts SET titulo = ?, conteudo = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $params['titulo']);
        $stmt->bindValue(2, $params['conteudo']);
        $stmt->bindValue(3, $params['id']);
        $result = $stmt->execute();
        if($result == 0) {
            throw new Exception("Falha ao atualizar publicação!");
            return false;
        }
        return true;
    }
    public static function delete($id) 
    {
        $con = Connection::getConn();

        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $id);
        $result = $stmt->execute();
        if($result == 0) {
            throw new Exception("Falha ao deletar publicação!");
            return false;
        }
        return true;
    }
}