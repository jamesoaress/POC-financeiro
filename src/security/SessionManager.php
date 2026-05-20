<?php
class SessionManager {
    public static function startSecureSession() {

        //Esse comando faz ele configurar cookies segguros antes de iniciar a sessão
        session_set_cookie_params([
        'lifetime' => 3600,
        'path' => '/',
        'domain' => '',
        'secure ' => true,
        'httponly' => true,
        'samesite' => 'Strict'
        ]);
        session_start();
    }
}

?>