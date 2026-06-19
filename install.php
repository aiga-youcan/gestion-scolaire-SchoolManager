<?php
// 1. Création des dossiers automatiquement
@mkdir('config', 0777, true);
@mkdir('includes', 0777, true);
@mkdir('pages', 0777, true);

// 2. Création de config/db.php
$db = <<<'PHP'
<?php
$host = 'localhost';
$dbname = 'schoolmanager';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>
PHP;
file_put_contents('config/db.php', $db);

// 3. Création de includes/header.php
$header = <<<'PHP'
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EduTech Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/schoolmanager/index.php">EduTech</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/schoolmanager/pages/eleves.php">Élèves</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
PHP;
file_put_contents('includes/header.php', $header);

// 4. Création de includes/footer.php
$footer = <<<'PHP'
    </div>
    <footer class="text-center mt-5 mb-3 text-muted">
        <p>&copy; 2026 EduTech Solutions.</p>
    </footer>
</body>
</html>
PHP;
file_put_contents('includes/footer.php', $footer);

// 5. Création de index.php
$index = <<<'PHP'
<?php 
require_once 'config/db.php';
require_once 'includes/header.php'; 
?>
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Bienvenue sur EduTech</h1>
        <p>Le projet a été installé avec succès ! L'architecture est prête.</p>
        <a href="pages/eleves.php" class="btn btn-primary btn-lg">Gérer les Élèves</a>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
PHP;
file_put_contents('index.php', $index);

// 6. Création de pages/eleves.php
$eleves = <<<'PHP'
<?php
require_once '../config/db.php';
require_once '../includes/header.php';
?>
<h2>Gestion des Élèves</h2>
<div class="alert alert-success">
    Félicitations ! L'application tourne parfaitement. La connexion à la base de données est réussie et les fichiers sont liés sans erreur.
</div>
<?php require_once '../includes/footer.php'; ?>
PHP;
file_put_contents('pages/eleves.php', $eleves);

// Message de succès
echo "<div style='font-family:sans-serif; text-align:center; margin-top:50px;'>";
echo "<h1 style='color:green;'>Nadi ! Projet généré avec succès ✅</h1>";
echo "<p>Tous les dossiers (config, includes, pages) et fichiers ont été créés.</p>";
echo "<a href='index.php' style='padding:10px 20px; background:blue; color:white; text-decoration:none; border-radius:5px;'>Ouvrir le projet</a>";
echo "</div>";
?>