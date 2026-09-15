<?php

class TarefasModel {
    private $db;

    public function __construct($conexao) {
        $this->db = $conexao;
    }

    public function buscarTodos() {

        $sql = "SELECT * FROM tareas";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {

        $sql = "SELECT * FROM tareas WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function buscarPorTitulo($titulo) {

        $sql = "SELECT * FROM tareas WHERE titulo LIKE :titulo";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['titulo' => '%' . $titulo . '%']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function buscarporusuario($usuario_id) {

        $sql = "SELECT * FROM tareas WHERE usuario_id = :usuario_id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute(['usuario_id' => $usuario_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function criar($dados) {

        $sql = "INSERT INTO tareas (usuario_id, categoria_id, titulo, descripcion, fecha, prioridad, completada, es_recurrente, frecuencia, fecha_creacion) 

        VALUES (:usuario_id, :categoria_id, :titulo, :descripcion, :fecha, :prioridad, :completada, :es_recurrente, :frecuencia, NOW())";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([

            'usuario_id' => $dados['usuario_id'],

            'categoria_id' => $dados['categoria_id'],

            'titulo' => $dados['titulo'],

            'descripcion' => $dados['descripcion'],

            'fecha' => $dados['fecha'],

            'prioridad' => $dados['prioridad'],

            'completada' => $dados['completada'],

            'es_recurrente' => $dados['es_recurrente'],

            'frecuencia' => $dados['frecuencia'],

        ]);

        return $this->db->lastInsertId();

    }

    public function atualizar($id, $dados) {

        $sql = "UPDATE tareas SET titulo = :titulo, descripcion = :descripcion, prioridad = :prioridad, completada = :completada, es_recurrente = :es_recurrente, frecuencia = :frecuencia WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            'titulo' => $dados['titulo'],

            'descripcion' => $dados['descripcion'],

            'prioridad' => $dados['prioridad'],

            'completada' => $dados['completada'],

            'es_recurrente' => $dados['es_recurrente'],

            'frecuencia' => $dados['frecuencia'],

            'id' => $id

        ]); 
    }

    public function excluir($id) {

        $sql = "DELETE FROM tareas WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);

    }

}