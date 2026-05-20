<?php
// Autoload simples (em um projeto real use o Composer)
require_once '../src/config/SecurityHeaders.php';
require_once '../src/security/SessionManager.php';
require_once '../src/security/CSRF.php';
require_once '../src/sodels/Database.php';
require_once '../src/models/Usuario.php';

// 1. Inicia Sessão Segura e Aplica Headers
SessionManager::startSecureSession();
SecurityHeaders::applyCSP();

// 2. Instanciação e Injeção de Dependência
$db = new Database('localhost', 'poc_financeiro', 'root', '');
$usuario = new Usuario($db);

// Mock de usuário logado para a POC
$_SESSION['usuario_id'] = 1; 

// 3. Processamento de Requisições (Simulação de Rotas)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CSRF::validateToken($_POST['csrf_token']); // Valida CSRF
    
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    
    $usuario->adicionarTransacao($_SESSION['usuario_id'], $descricao, $valor);
    header("Location: index.php");
    exit;
}

$transacoes = $usuario->listarTransacoes($_SESSION['usuario_id']);
$csrf_token = CSRF::generateToken();

// Renderiza a View
require_once '../src/Views/dashboard.php';
?>