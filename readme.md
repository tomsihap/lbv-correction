# Correction du projet LBV (Examen Symfony 5)

## Setup

### 1. Configuration du projet

- Ouvrez le projet et lancez la commande `composer install`
- Copiez le fichier `.env` existant en un fichier `.env.local` et remplissez la constante `DATABASE_URL` avec votre configuration locale.

### 2. Mise en place de la base de données

Dans un terminal dans le dossier du projet :
- `php bin/console doctrine:database:create`
- `php bin/console doctrine:migrations:migrate`
- `php bin/console doctrine:fixtures:load`


### 3. Lancer le serveur

Dans un terminal dans le dossier du projet :

- `symfony server:start`
- Lancez l'application à l'adresse indiquée par le terminal (habituellement https://localhost:8000)

#### 4. Tester l'application

Les utilisateurs suivants sont disponibles :

- Login : `user@user.com` / Mot de passe : `user@user.com`
- Login : `user2@user.com` / Mot de passe : `user2@user.com`
- Login : `admin@user.com` / Mot de passe : `admin@user.com`
