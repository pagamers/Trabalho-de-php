    <?php

    class SubtareasModel {
        private $db;

        public function __construct($conexao) {
            $this->db = $conexao;
        }

        public function buscarPorTareaId($tarea_id) {

            $sql = "SELECT * FROM subtareas WHERE tarea_id = :tarea_id";

            $stmt = $this->db->prepare($sql);

            $stmt->execute(['tarea_id' => $tarea_id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function criar($dados) {

            $sql = "INSERT INTO subtareas (tarea_id, titulo, completada) 

            VALUES (:tarea_id, :titulo,:completada)";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([

                'tarea_id' => $dados['tarea_id'],

                'titulo' => $dados['titulo'],

                'completada' => $dados['completada']
            ]);

            return $this->db->lastInsertId();
        }

        public function atualizar($id, $dados) {

            $sql = "UPDATE subtareas SET titulo = :titulo, completada = :completada WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([

                'titulo' => $dados['titulo'],

                'completada' => $dados['completada'],

                'id' => $id
            ]);
        }

        public function deletar($id) {

            $sql = "DELETE FROM subtareas WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute(['id' => $id]);
        }

    }
    ?>

