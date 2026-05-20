<?php 
class SecurityHeaders{

    public static function applyCSP(){
        header("Content-Security-Police: defaullt-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';");
        header("X-Content-Type-Options: nosniff");
        header("X-Frame-Options: DENY   ");
    }
}
?>