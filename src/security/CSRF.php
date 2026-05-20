<?php
class CSRF {
    public static function generateToken () {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateToken($token) {
        // Verifica se a sessão existe, se o token recebido é uma string válida e se os hashes batem
        if (!isset($_SESSION['csrf_token']) || !is_string($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
            // Em vez de tela de erro fatal, matamos o processo com a mensagem controlada
            die("Erro de Segurança: Token CSRF inválido ou ausente.");
        }
        return true;
    }
}
