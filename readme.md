# Médiathèque PHP - Exercice Héritage et MVC

## Objectif

Cet exercice a pour but de vous familiariser avec le concept d'héritage en PHP en créant une application simple de gestion de médiathèque. Vous allez utiliser le Design Pattern MVC pour modéliser et manipuler des objets représentant des médias (Livres, DVD, CD, Musiques) pouvant être loués.

---

## Fonctionnalités

### 1. Gestion des Médias
- **Classe générique `Media`** avec :
  - `titre` (string)
  - `auteur` (string)
  - `disponible` (booléen)
  - Méthodes communes :
    - `emprunter()`
    - `rendre()`
- **Classes enfants** :
  - `Book` : propriété `pageNumber` (int)
  - `Movie` : propriétés `duration` (double) et `genre` (enum)
  - `Album` : propriétés `songNumber` (int) et `editor` (string)
- Gestion de la liste des médias :
  - Ajouter, modifier et supprimer des médias (uniquement pour les utilisateurs authentifiés)
  - Emprunter et rendre des médias
  - Recherche approximative de films
  - Optionnel : gestion d’illustrations en BLOB par média

---

### 2. Application MVC
- Séparation du code en :
  - **Modèles** : gestion des données et des objets médias
  - **Vues** : affichage des médias, formulaire d'authentification, tableau de bord
  - **Contrôleurs** : traitement des requêtes utilisateurs, logique métier

---

### 3. Authentification
- Système d’inscription et de connexion pour les utilisateurs
- Mots de passe hashés et gestion des sessions
- Regex pour mot de passe :
  - Minimum 8 caractères
  - Au moins une majuscule, une minuscule, un chiffre et un caractère spécial
  - Le mot de passe ne doit pas contenir l’identifiant de l’utilisateur

---

### 4. Tableau de Bord
- Affichage de la liste des médias avec leur disponibilité
- Affichage du nom de l’utilisateur connecté
- Barre de navigation avec lien de déconnexion

---

## Structure du Projet
/MVC-MEDIATHEQUE
├── /assets
│ ├── /css
│ ├── /ico
│ ├── /doc
│ └── /js
├── /Controllers
│ ├── LoginController.php
│ ├── RegisterController.php
├── /Models
│ ├── Album.php
│ ├── Book.php
│ ├── connexion.php
│ ├── logout.php
│ ├── genre.php
│ ├── Media.php
│ ├── Song.php
│ ├── User.php
│ ├── Genre.php
├── /Views
│ ├── add-media.php
│ ├── edit-media.php
│ ├── list-media.php
│ ├── error-404.php
│ ├── home.php
│ ├── logout.php
│ ├── login.php
│ └── register.php
├── .gitignore
├── .htaccess
├── index.php
├── mediatheque.sql
└── README.md
