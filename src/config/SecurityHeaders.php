<?php 
class SecurityHeaders{

    public static function applyCSP(){
        header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self';");
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: DENY   ");
    }
}
