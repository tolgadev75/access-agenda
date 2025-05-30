<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
    <a href="https://vuejs.org" target="_blank">
        <img src="https://raw.githubusercontent.com/vuejs/art/master/logo.svg" width="200" alt="Vue.js Logo">
    </a>
</p>

# Access-Agenda

Access-Agenda est une plateforme permettant de découvrir et de partager des activités sportives accessibles aux personnes en situation de handicap.

## 🌐 Site web

**Accéder à l'application :** [https://access-agenda.duckdns.org/](https://access-agenda.duckdns.org/)

## Fonctionnalités

- Accessibilité : Conçue selon les normes d'accessibilité web, utilisable au clavier et compatible avec les technologies d'assistance

- CRUD : Parcourez, créez, modifiez et supprimez des activités sportives

- Filtres d'accessibilité : Visualisez rapidement les activités adaptées aux différents types de handicap (mobilité, vision, auditif, cognitif)

- Notifications visuelles de succès et d’erreur pour l'ajout, modification et suppression d'activités

- Interface responsive adaptée aux mobiles et tablettes

## Technologies utilisées

- Backend : Laravel 12

- Frontend : Vue.js 3 avec Composition API et Inertia.js

- Styles : Tailwind CSS

- Base de données : MySQL

## Installation

1. Clonez ce dépôt : 
```bash
git clone https://github.com/votre-compte/access-agenda.git
cd access-agenda
``` 

2. Installez les dépendances
```bash
composer install
npm install
``` 

3. Configurez l'environnement
```bash
cp .env.example .env
php artisan key:generate
``` 

4. Configurez votre base de données dans le fichier `.env`

5. Lancez les migrations et les seeders
```bash
php artisan migrate
php artisan db:seed
``` 

6. Compilez les assets frontend
```bash
npm run dev
``` 

7. Lancez le serveur
```bash
php artisan serve
``` 
## Tests
Ce projet utilise PHPUnit pour les tests unitaires.

Pour exécuter les tests :
```bash
php artisan test
``` 

## Structure du projet

- `app/Http/Controllers/ActivityController.php` : Contrôleur pour la gestion des activités
- `resources/js/Pages/` : Composants Vue pour les différentes pages
- `resources/js/Components/` : Composants réutilisables (badges d'accessibilité, pagination, etc.)
- `resources/js/Layouts/` : Layout principal accessible


