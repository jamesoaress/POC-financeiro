<?php
class SessionManager {
    public static function startSecureSession() {
        session_set_cookie_params([
        'lifetime' => 3600,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite'=> 'Strict'
        ]);
        session_start();
    }
}

