<?php
// Activer aussi les erreurs ici pour être sûr
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config/db.php';

if (isset($_SESSION['admin_logged'])) {
    header('Location: index.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_input = isset($_POST['user']) ? trim($_POST['user']) : '';
    $password   = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($user_input) && !empty($password)) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE user = :user LIMIT 1");
            $stmt->execute([':user' => $user_input]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_user']   = $admin['user'];
                
                header('Location: index.php');
                exit;
            } else {
                $error = "Nom d'utilisateur ou Mot de passe incorrect !";
            }
        } catch (PDOException $e) {
            $error = "Erreur de base de données : " . $e->getMessage();
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

<div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 12px;">
    <h4 class="text-center mb-4">Connexion Admin</h4>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center small"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label class="form-label admin-label">Utilisateur (User)</label>
            <input type="text" name="user" class="form-control" placeholder="admin" required>
        </div>
        <div class="mb-4">
            <label class="form-label admin-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">Se connecter</button>
    </form>
</div>

</body>
</html>