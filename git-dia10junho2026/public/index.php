<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use App\Controllers\TarefaController;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

// Configuracao do SQLite
$dbFile = __DIR__ . '/../database.sqlite';
$pdo = new PDO("sqlite:$dbFile");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// Garante que a tabela exista
$pdo->exec("CREATE TABLE IF NOT EXISTS tarefas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titulo TEXT NOT NULL,
    concluido INTEGER DEFAULT 0
)");

// Instancia o Controller injetando o PDO
$controller = new TarefaController($pdo);

// ------------------- ROTA DA INTERFACE -------------------
$app->get('/', function (Request $request, Response $response) {
    $html = file_get_contents(__DIR__ . '/index.html');
    $response->getBody()->write($html);
    return $response->withHeader('Content-Type', 'text/html');
});

// ------------------- ROTAS DA API REST (Controller) -------------------
$app->get('/api/tarefas', [$controller, 'listar']);
$app->post('/api/tarefas', [$controller, 'criar']);
$app->put('/api/tarefas/{id}', [$controller, 'atualizar']);
$app->delete('/api/tarefas/{id}', [$controller, 'deletar']);

$app->run();
