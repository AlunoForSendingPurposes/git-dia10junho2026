<?php
namespace App\Models;

class Tarefa {
    public ?int $id;
    public string $titulo;
    public int $concluido;

    public function __construct(?int $id, string $titulo, int $concluido = 0) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->concluido = $concluido;
    }
}
