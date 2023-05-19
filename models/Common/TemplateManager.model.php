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
            if($_SESSION['user']['role'] === 'user'|| $_SESSION['user']['role'] === 'admin'){
                $menuItems[] = [
                    'name' => 'Mon compte',
                    'url' => 'account/mon_compte',
                ];
                $menuItems[] = [
                    'name' => 'Déconnexion',
                    'url' => 'account/deconnexion',
                ];
            }
            if($_SESSION['user']['role'] === 'admin'){
                $menuItems[] = [
                    'name' => 'Administration',
                    'url' => 'admin/Administration',
                ];
            }
        }

        return $menuItems;
    }
}
