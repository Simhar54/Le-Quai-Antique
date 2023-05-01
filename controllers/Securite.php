<?php

class Securite
{


    public const COOKIE_NAME = "timers";

    /**
     * Generates a secure authentication cookie for the user upon successful login.
     * The cookie contains a hashed value composed of the session ID, the current microtime, and a random number.
     * The cookie is set to expire in 20 minutes and is configured with the "Secure" and "HttpOnly" attributes.
     * The hashed value is also stored in the user's session under the 'profil' key.
     */
    public static function genererCookieConnexion()
    {
        $ticket = session_id() . microtime() . rand(0, 999999);
        $ticket = hash("sha512", $ticket);

        $cookieName = self::COOKIE_NAME;
        $cookieValue = $ticket;
        $expiration = time() + (60 * 20); 
        $path = "/"; 
        $secure = true; 
        $httpOnly = true;

        setcookie($cookieName, $cookieValue, $expiration, $path, "", $secure, $httpOnly);

        $_SESSION['profil'][$cookieName] = $ticket;
    }

    public static function checkAuthentification() {
        if (isset($_COOKIE[self::COOKIE_NAME]) && isset($_SESSION['profil'][self::COOKIE_NAME])) {
            if ($_COOKIE[self::COOKIE_NAME] === $_SESSION['profil'][self::COOKIE_NAME]) {
                return true;
            }
        }
        
        unset($_SESSION['profil']);
        setcookie(self::COOKIE_NAME, "", time() - 3600); 
        
        return false;
    }
    
}
