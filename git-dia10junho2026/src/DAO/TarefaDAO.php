<?php
namespace App\DAO;

use PDO;

class TarefaDAO {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodas(): array {
        $stmt = $this->pdo->query("SELECT * FROM tarefas ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function criar(string $titulo): array {
        $stmt = $this->pdo->prepare("INSERT INTO tarefas (titulo) VALUES (:titulo)");
        $stmt->execute(['titulo' => $titulo]);
        
        return [
            'id' => (int)$this->pdo->lastInsertId(),
            'titulo' => $titulo,
            'concluido' => 0
        ];
    }

    public function atualizar(int $id, ?int $concluido): bool {
        $stmt = $this->pdo->prepare("UPDATE tarefas SET concluido = COALESCE(:concluido, concluido) WHERE id = :id");
        return $stmt->execute(['concluido' => $concluido, 'id' => $id]);
    }

    public function deletar(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
