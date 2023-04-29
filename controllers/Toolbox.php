<?php

class Toolbox
{
    public const COULEUR_ROUGE = "alert-danger";
    public const COULEUR_ORANGE = "alert-warning";
    public const COULEUR_VERTE = "alert-success";

    public static function addMessageAlerte($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }

    public static function displayAlerts() {
        if (!empty($_SESSION['alert'])) {
            foreach ($_SESSION['alert'] as $alert) {
                echo "<div class='alert col col-8 mx-auto " . $alert['type'] . "' role='alert'>" . $alert['message'] . "</div>";
            }
            unset($_SESSION['alert']);
        }
    }
    
}