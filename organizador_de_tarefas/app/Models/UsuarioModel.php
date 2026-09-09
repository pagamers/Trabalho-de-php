<?php

class UsuarioModel {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }
    public function buscarTodos() {
        $sql = "SELECT * FROM tarefas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados) {
        $sql = "INSERT INTO tarefas (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nome' => $dados['nome']]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados) {
        $sql = "UPDATE tarefas SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['nome' => $dados['nome'], 'id' => $id]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM tarefas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}