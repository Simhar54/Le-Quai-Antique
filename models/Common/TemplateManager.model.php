<?php

class TemplateManager
{
    public function getMenuItems()
    {
        $menuItems = [
            [
                'name' => 'Accueil',
                'url' => 'accueil',
            ],
            [
                'name' => 'Carte',
                'url' => 'carte',
            ],
            [
                'name' => 'Menus',
                'url' =>  'menus',
            ],
            [
                'name' => 'Réservation',
                'url' => 'reservation',
            ],
            [
                'name' => 'Contact',
                'url' => 'contact',
            ],
        ];
        if (empty($_SESSION['user'])) {
            $menuItems[] = [
                'name' => 'Connexion',
                'url' => 'connexion',
            ];
            $menuItems[] =
                [
                    'name' => 'Inscription',
                    'url' => 'inscription',
                ];
        } else {
            if($_SESSION['user']['role'] === 'user'){
                $menuItems[] = [
                    'name' => 'Mon compte',
                    'url' => 'mon-compte',
                ];
                $menuItems[] = [
                    'name' => 'Déconnexion',
                    'url' => 'deconnexion',
                ];
            }
        }

        return $menuItems;
    }
}
