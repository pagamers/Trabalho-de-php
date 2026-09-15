<?php

class UsuarioModel {
    private $db;

    public function __construct($conexao) {

        $this->db = $conexao;

    }

    public function buscarTodos() {

        $sql = "SELECT * FROM usuarios";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }public function buscarPorId($id) {

        $sql = "SELECT * FROM usuarios WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    } 
    
    public function buscarPorEmail($email) {

        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    public function criar($dados) {

        $sql = "INSERT INTO usuarios (nombre, email, contrasena, fecha_registro) 

        VALUES (:nombre, :email, :contrasena, NOW())";
        
        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'nombre' => $dados['nombre'],

            'email' => $dados['email'],

            'contrasena' => $dados['contrasena']]);

        return $this->db->lastInsertId();

    }

    public function atualizar($id, $dados) {

        $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, contrasena = :contrasena WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['nombre' => $dados['nombre'], 'email' => $dados['email'], 'contrasena' => $dados['contrasena'], 'id' => $id]);

    }

    public function excluir($id) {

        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

}