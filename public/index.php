<?php
require_once '../src/config/SecurityHeaders.php';
require_once '../src/security/SessionManager.php';
require_once '../src/security/CSRF.php';
require_once '../src/models/Database.php';
require_once '../src/models/Usuario.php';

SessionManager::startSecureSession();
SecurityHeaders::applyCSP();

$db = new Database('localhost', 'poc_financeiro', 'root', '');
$usuario = new Usuario($db);

$action = $_GET['action'] ?? 'dashboard';

if ($action === 'logout') {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header("Location: index.php?action=login");
    exit;
}

$isLoggedIn = isset($_SESSION['usuario_id']);

if (!$isLoggedIn && $action === 'dashboard') {
    header("Location: index.php?action=login");
    exit;
}

if ($isLoggedIn && ($action === 'login' || $action === 'cadastro')) {
    header("Location: index.php?action=dashboard");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token_enviado = $_POST['csrf_token'] ?? '';
    CSRF::validateToken($token_enviado);

    if ($action === 'cadastro') {
        $usuario->cadastrarUsuario($_POST['nome'], $_POST['email'], $_POST['senha']);
        header("Location: index.php?action=login&cadastrado=true");
        exit;
    }

    if ($action === 'login') {
        $userData = $usuario->verificarCredenciais($_POST['email'], $_POST['senha']);
        
        if ($userData) {
            $_SESSION['usuario_id'] = $userData['id']; 
            $_SESSION['usuario_nome'] = $userData['nome']; 
            
            header("Location: index.php?action=dashboard");
            exit;
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    }

    if ($action === 'dashboard') {
        $descricao = $_POST['descricao'] ?? '';
        $valor = $_POST['valor'] ?? 0;

        $usuario->adicionarTransacao($_SESSION['usuario_id'], $descricao, $valor);
        
        header("Location: index.php?action=dashboard");
        exit;
    }
}

$csrf_token = CSRF::generateToken(); 

if ($action === 'login') {
    require_once '../src/Views/login.php';
} elseif ($action === 'cadastro') {
    require_once '../src/Views/cadastro.php';
} else {
    // Busca as transações apenas do usuário logado antes de desenhar a tela
    $transacoes = $usuario->listarTransacoes($_SESSION['usuario_id']);
    require_once '../src/Views/dashboard.php';
}
?>