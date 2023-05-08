## Prérequis

- PHP 8 ou supérieur
- Composer (gestionnaire de dépendances PHP)

## Installation

1. Clonez le dépôt Git :

   git clone https://github.com/Simhar54/Le-Quai-Antique

2. Accédez au répertoire du projet :

   cd Le-Quai-Antique

3. Installez les dépendances à l'aide de Composer :

   composer install

4. Créez un fichier `.env` à la racine du projet.

5. Ouvrez le fichier `.env` avec un éditeur de texte et ajoutez les valeurs des variables d'environnement suivantes selon votre configuration locale :

# Configuration de la base de données
   DB_HOST=localhost
   DB_NAME=ma_base_de_donnees
   DB_USER=utilisateur
   DB_PASSWORD=mot_de_passe

   # Configuration SMTP pour PHPMailer
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_SECURE=tls
   SMTP_AUTH=true
   SMTP_USERNAME=votre_adresse_email@gmail.com
   SMTP_PASSWORD=votre_mot_de_passe

  

