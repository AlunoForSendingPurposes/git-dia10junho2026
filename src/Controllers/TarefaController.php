<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DAO\TarefaDAO;
use PDO;

class TarefaController {
    private TarefaDAO $tarefaDAO;

    public function __construct(PDO $pdo) {
        $this->tarefaDAO = new TarefaDAO($pdo);
    }

    public function listar(Request $request, Response $response): Response {
        $tarefas = $this->tarefaDAO->listarTodas();
        $response->getBody()->write(json_encode($tarefas));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function criar(Request $request, Response $response): Response {
        $body = $request->getParsedBody();
        $titulo = $body['titulo'] ?? '';

        if (empty($titulo)) {
            $response->getBody()->write(json_encode(['erro' => 'Titulo obrigatorio']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        $novaTarefa = $this->tarefaDAO->criar($titulo);
        $response->getBody()->write(json_encode($novaTarefa));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function atualizar(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $body = $request->getParsedBody();
        $concluido = isset($body['concluido']) ? (int)$body['concluido'] : null;

        $this->tarefaDAO->atualizar($id, $concluido);
        $response->getBody()->write(json_encode(['status' => 'Atualizado']));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function deletar(Request $request, Response $response, array $args): Response {
        $id = (int)$args['id'];
        $this->tarefaDAO->deletar($id);
        $response->getBody()->write(json_encode(['status' => 'Removido']));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
