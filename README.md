# 🎓 SchoolManager

SchoolManager est une application web de gestion scolaire développée en **PHP**, **MySQL** et **PDO**. Elle permet de centraliser la gestion des élèves, enseignants, classes, matières, inscriptions et affectations dans un établissement scolaire.

---

# 📌 Objectif

L'objectif de ce projet est de remplacer la gestion manuelle (Excel et documents papier) par une application web sécurisée garantissant :

- La centralisation des données
- La cohérence des informations
- La réduction des doublons
- Le respect des contraintes d'intégrité
- Une gestion simple des opérations CRUD

---

# 🚀 Fonctionnalités

## Gestion des élèves
- Ajouter un élève
- Modifier un élève
- Supprimer un élève
- Afficher la liste des élèves

## Gestion des enseignants
- Ajouter un enseignant
- Modifier un enseignant
- Supprimer un enseignant
- Gestion des emails et matricules uniques

## Gestion des classes
- Ajouter une classe
- Modifier une classe
- Supprimer une classe (si aucune inscription)
- Définir la capacité maximale

## Gestion des matières
- Ajouter une matière
- Modifier une matière
- Supprimer une matière (si aucune affectation)

## Gestion des inscriptions
- Inscrire un élève dans une classe
- Choisir l'année scolaire
- Vérifier la capacité maximale
- Empêcher les doublons

## Gestion des affectations
- Affecter un enseignant à une classe et une matière
- Éviter les affectations en double
- Modifier ou supprimer une affectation

---

# 🛠 Technologies utilisées

- PHP 8
- MySQL
- PDO
- HTML5
- CSS3
- Bootstrap 5
- XAMPP
- phpMyAdmin
- Git & GitHub

---

# 📂 Structure du projet

```
SchoolManager/

│
├── config/
│   └── config.php
│
├── database/
│   └── schoolmanager.sql
│
├── includes/
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── pages/
│   ├── eleves/
│   ├── enseignants/
│   ├── classes/
│   ├── matieres/
│   ├── inscriptions/
│   └── affectations/
│
├── assets/
│   ├── css/
│   └── images/
│
├── index.php
└── README.md
```

---

# 🗄 Base de données

Les principales tables sont :

- eleves
- enseignants
- classes
- matieres
- inscriptions
- affectations

Les contraintes utilisées :

- PRIMARY KEY
- FOREIGN KEY
- UNIQUE
- NOT NULL

---

# 📖 Règles de gestion

- Chaque élève possède un matricule unique.
- Chaque enseignant possède un matricule et un email uniques.
- Une classe possède un nom unique par année scolaire.
- Une inscription relie un élève, une classe et une année scolaire.
- Un élève appartient à une seule classe par année scolaire.
- Une classe ne peut pas dépasser sa capacité maximale.
- Une matière peut être enseignée par plusieurs enseignants.
- Une affectation relie un enseignant, une classe et une matière.
- Les suppressions respectent l'intégrité référentielle.

---

# 🔒 Sécurité

Le projet applique plusieurs mesures de sécurité :

- Requêtes préparées avec PDO
- Protection contre les injections SQL
- Validation des données côté serveur
- Protection XSS avec `htmlspecialchars()`
- Gestion des erreurs utilisateur

---

# 💻 Installation

## 1. Cloner le projet

```bash
git clone https://github.com/votre-compte/SchoolManager.git
```

## 2. Copier le projet dans

```
xampp/htdocs/
```

## 3. Créer la base de données

Créer une base :

```
schoolmanager
```

Importer ensuite le fichier :

```
database/schoolmanager.sql
```

## 4. Configurer la connexion

Modifier le fichier :

```
config/config.php
```

```php
<?php

$host = "localhost";
$dbname = "schoolmanager";
$user = "root";
$password = "";

try{
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die($e->getMessage());
}
```

## 5. Lancer XAMPP

Démarrer :

- Apache
- MySQL

Puis ouvrir :

```
http://localhost/SchoolManager
```

---

# 📸 Captures d'écran

À ajouter :

- Dashboard
- Liste des élèves
- Liste des enseignants
- Gestion des classes
- Gestion des inscriptions
- Gestion des affectations

---

# 📋 Livrables

- ✔ MCD
- ✔ MLD
- ✔ Script SQL
- ✔ Application PHP
- ✔ CRUD complet
- ✔ Connexion PDO
- ✔ README
- ✔ GitHub
- ✔ Jira

---

# 👨‍💻 Auteurs

Projet réalisé dans le cadre de la formation **Développeur Web et Web Mobile**.

Binôme :

- SABRAR Rida
- NADI  Maryem

---

# 📄 Licence

Projet pédagogique réalisé uniquement dans le cadre de la formation.
