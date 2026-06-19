<?php 
require_once 'config/db.php';
include_once 'includes/header.php'; // كيحمي الصفحة ويجيب الـ Design

try {
    // حساب الإحصائيات الحقيقية من جداول قاعدة البيانات ديالك
    $countClasses = $pdo->query("SELECT COUNT(*) FROM classe")->fetchColumn();
    $countEleves = $pdo->query("SELECT COUNT(*) FROM eleve")->fetchColumn();
    $countEnseignants = $pdo->query("SELECT COUNT(*) FROM enseignant")->fetchColumn();
    $countInscriptions = $pdo->query("SELECT COUNT(*) FROM inscription")->fetchColumn();

    // جلب آخر 3 تسجيلات حقيقية بربط الجداول (JOIN)
    $sqlRecent = "SELECT i.date_inscription, e.nom, e.prenom, c.nom_classe 
                  FROM inscription i
                  JOIN eleve e ON i.id_eleve = e.id_eleve
                  JOIN classe c ON i.id_classe = c.id_classe
                  ORDER BY i.id_inscription DESC LIMIT 3";
    $recentInscriptions = $pdo->query($sqlRecent)->fetchAll();
} catch (PDOException $e) {
    $error_db = "Erreur lors du chargement des statistiques.";
}
?>

<div class="mb-5">
    <h3 class="fw-bold tracking-tight m-0" style="color: #09090b;">Vue d'ensemble</h3>
    <p class="text-muted small m-0">Résumé global de l'état actuel de votre établissement scolaire.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-xl-3 col-sm-6">
        <div class="card p-4 border shadow-sm bg-white" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted small fw-semibold text-uppercase">Élèves Totaux</span>
                <div class="rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #eff6ff; color: #3b82f6;"><i class="fa-solid fa-user-graduate fs-5"></i></div>
            </div>
            <h2 class="fw-bold m-0 tracking-tight"><?= $countEleves ?></h2>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card p-4 border shadow-sm bg-white" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted small fw-semibold text-uppercase">Enseignants</span>
                <div class="rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #fdf2f8; color: #ec4899;"><i class="fa-solid fa-user-tie fs-5"></i></div>
            </div>
            <h2 class="fw-bold m-0 tracking-tight"><?= $countEnseignants ?></h2>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card p-4 border shadow-sm bg-white" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted small fw-semibold text-uppercase">Nombre Classes</span>
                <div class="rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #f0fdf4; color: #22c55e;"><i class="fa-solid fa-school fs-5"></i></div>
            </div>
            <h2 class="fw-bold m-0 tracking-tight"><?= $countClasses ?></h2>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="card p-4 border shadow-sm bg-white" style="border-radius: 12px;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="text-muted small fw-semibold text-uppercase">Inscriptions</span>
                <div class="rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #fef3c7; color: #d97706;"><i class="fa-solid fa-file-signature fs-5"></i></div>
            </div>
            <h2 class="fw-bold m-0 tracking-tight"><?= $countInscriptions ?></h2>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border bg-white shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white py-3 border-bottom"><h6 class="fw-bold m-0 text-dark"><i class="fa-solid fa-clock-rotate-left me-2 text-muted"></i> Dernières Inscriptions</h6></div>
            <div class="table-responsive">
                <table class="table align-middle m-0">
                    <thead>
                        <tr class="table-light">
                            <th>Élève</th>
                            <th>Classe</th>
                            <th>Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentInscriptions)): ?>
                            <tr><td colspan="3" class="text-center py-4 text-muted small">Aucune inscription récente.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recentInscriptions as $ri): ?>
                                <tr>
                                    <td class="fw-semibold text-dark"><?= htmlspecialchars($ri['nom'] . ' ' . $ri['prenom']) ?></td>
                                    <td><span class="badge bg-light text-dark border px-2 py-1"><?= htmlspecialchars($ri['nom_classe']) ?></span></td>
                                    <td class="text-muted small"><?= htmlspecialchars($ri['date_inscription']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card p-4 border bg-white shadow-sm" style="border-radius: 12px;">
            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-wand-magic-sparkles me-2 text-muted"></i> Actions Rapides</h6>
            <div class="d-grid gap-2">
                <a href="pages/eleves_add.php" class="btn btn-dark text-start d-flex align-items-center justify-content-between py-2.5" style="border-radius: 8px;">
                    <span><i class="fa-solid fa-user-plus me-2"></i> Inscrire un nouvel élève</span><i class="fa-solid fa-chevron-right small opacity-50"></i>
                </a>
                <a href="pages/classes_add.php" class="btn btn-light border text-start d-flex align-items-center justify-content-between py-2.5" style="background: #ffffff; border-radius: 8px;">
                    <span class="text-dark"><i class="fa-solid fa-plus me-2 text-muted"></i> Ajouter une classe</span><i class="fa-solid fa-chevron-right small text-muted opacity-50"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>