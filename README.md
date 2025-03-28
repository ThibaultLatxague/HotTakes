# HotTakes - Application de gestion de sauces

**HotTakes** est une application une application web dans laquelle les utilisateurs peuvent ajouter leurs sauces préférées et liker ou disliker les sauces ajoutées par les autres.. Ce projet utilise Laravel comme framework PHP et SQLite pour la gestion de la base de données.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [PHP](https://www.php.net/downloads) (version 8.0 ou supérieure)
- [Composer](https://getcomposer.org/) (gestionnaire de dépendances PHP)
- [Laravel](https://laravel.com/) (version 9.x ou supérieure)
- [SQLite](https://www.sqlite.org/download.html) ou tout autre gestionnaire de base de données compatible avec Laravel

## Installation

### 1. Cloner le dépôt

Commencez par cloner le dépôt Git de l'application sur votre machine locale :

```bash
git clone https://github.com/maximeBourciez/HotTakes.git
cd HotTakes
```

## 2. Installer les dépendances

Une fois dans le répertoire du projet, vous devez installer les dépendances PHP et Node nécessaires. Utilisez Composer et npm pour cela :

```bash
composer install
npm i
```

## 3. Configurer l'environnement

Copiez le fichier .env.example pour créer votre propre fichier .env :
```bash
cp .env.example .env
```

## 4. Configuration de la base de données

Dans le fichier .env, assurez-vous que la configuration de la base de données est correctement définie. Par défaut, cette application utilise SQLite, mais vous pouvez également utiliser MySQL si vous préférez.

Pour SQLite, modifiez la ligne suivante dans votre fichier ```.env``` :

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite
```

Et créez le fichier de la base de données : 
```bash
touch database/database.sqlite
```


Si vous utilisez SQLite, assurez-vous que le répertoire ```database``` existe et que le fichier ```database.sqlite``` est créé ou sera créé automatiquement par Laravel.

Si vous souhaitez utiliser MySQL, modifiez la configuration de la base de données dans le .env :

```env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

## 5. Générer la clé d'application

Laravel nécessite une clé d'application pour fonctionner correctement. Exécutez la commande suivante pour générer cette clé :

```bash
php artisan key:generate
```

## 6. Exécuter les migrations

Si vous utilisez SQLite ou MySQL, vous devez exécuter les migrations et les seeders pour créer les tables et données nécessaires dans votre base de données. Exécutez les commandes suivantes pour effectuer cette opération :
```bash
php artisan migrate
php artisan db:seed
```

Cela créera les tables de base de données nécessaires pour stocker les informations relatives aux sauces, aux utilisateurs et aux réactions (likes/dislikes).

## 7. Démarrer le serveur de développement

Une fois les migrations exécutées, vous pouvez démarrer le serveur de développement de Laravel avec la commande suivante :
```bash
php artisan serve
```
Le serveur sera accessible à l'adresse ```http://localhost:8000```.
## 8. Testez l'application

Accédez à l'URL fournie (par défaut http://localhost:8000) et vous devriez voir l'interface de l'application. Vous pouvez maintenant ajouter des sauces, les liker ou les disliker, et explorer les différentes fonctionnalités offertes par l'application.
