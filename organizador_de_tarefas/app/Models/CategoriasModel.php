<?php

class CategoriasModel {

    private $db;

    public function __construct($conexao) {

        $this->db = $conexao;

    }

public function buscarPorId($id) {

        $sql = "SELECT * FROM categorias WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

 public function buscarporusuario($usuario_id) {

        $sql = "SELECT * FROM categorias WHERE usuario_id = :usuario_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['usuario_id' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
 public function criar($dados) {

        $sql = "INSERT INTO categorias (usuario_id, nombre, color)

        VALUES (:usuario_id, :nombre, :color)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'usuario_id' => $dados['usuario_id'],

            'nombre' => $dados['nombre'],

            'color' => $dados['color']]);
        
        return $this->db->lastInsertId();

    }
 public function deletar($id) {
     
        $sql = "DELETE FROM categorias WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);

    }
 public function atualizar($id, $dados){

        $sql = "UPDATE categorias SET nombre = :nombre, color = :color WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'nombre' => $dados['nombre'],

            'color' => $dados['color'],

            'id' => $id

        ]);

    }
 }
 ?>