# CraftedBy - API

## ABOUT

This project is an e-commerce app called "Crafted By".
It is the backend API developed with Laravel framework.

## REQUIREMENT 

* PHP 8.0 or higher
* Laravel 10
* Composer 2.0 or higher
* PostgreSQL 12.18

## INSTALLATION

1. Fork & clone repository.
2. Navigate to the project directory.
3. Install project dependencies : 
```
composer install
```
4. Copy `.env.example` file to `.env`.
5. Generate a new application key: 
```
php artisan key:generate
```
6. Set DB connection in the `.env` file :
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=<DB_name>
DB_USERNAME=<DB_username>
DB_PASSWORD=<DB_password>
```
7. Run migrations :
```
php artisan migrate
```
8. If needed : seed DB to populate catalogue :
```
php artisan db:seed --class=DatabaseSeeder
```
9. Start development server :
```
php artisan serve
```

## IF NEEDED - INSTALLATION OF POSTGRESQL :

sudo apt install postgresql<br>
sudo -i -u postgres<br>

psql<br>
CREATE ROLE<br>
sudo apt install postgresql<br>
sudo -i -u postgres<br>

psql<br>
CREATE ROLE <nom_utilisateur> LOGIN;<br>
ALTER ROLE <nom_utilisateur> CREATEDB;<br>
CREATE DATABASE <nom_base_de_donnee> OWNER <nom_utilisateur>;<br>
ALTER ROLE <nom_utilisateur> WITH ENCRYPTED PASSWORD 'mon_mot_de_passe';<br>
\q (pour quitter)<br>

