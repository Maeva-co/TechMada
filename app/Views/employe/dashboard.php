<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>TechMada RH — Gestion des congés CI4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="<?= base_url('js/app.js') ?>"></script>
</head>

<body>
    <section id="page-dashboard-employe" style="margin-top:3rem">
    <div class="app-wrap">

    <!-- SIDEBAR EMPLOYÉ -->
    <aside class="sidebar">
        <div class="sidebar-brand">
        <div class="sidebar-logo-icon"><i class="bi bi-briefcase"></i></div>
        <div class="sidebar-brand-name">TechMada RH<span>Espace employé</span></div>
        </div>
        <div class="sidebar-section">Menu</div>
        <ul class="sidebar-nav">
        <li><a href="/employe/dashboard" class="active"><i class="bi bi-grid-1x2"></i> Tableau de bord</a></li>
        <li><a href="/employe/create"><i class="bi bi-plus-circle"></i> Nouvelle demande</a></li>
        <li>
            <a href="/employe/index">
            <i class="bi bi-calendar3"></i> Mes demandes
            <span class="nav-badge alert">2</span>
            </a>
        </li>
        <li><a href="#page-profil-employe"><i class="bi bi-person"></i> Mon profil</a></li>
        <li><a href="<?= base_url('auth/logout') ?>" style="margin-left:auto;color:rgba(255,255,255,.25);font-size:1.1rem"><i class="bi bi-box-arrow-right"></i>Déconnexion</a></li>
        </ul>
        <div class="sidebar-user">
        <div class="s-user-row">
            <<div class="avatar av-green">USER</div>
            <div><div class="user-name">
                <?= esc(session()->get('prenom') . ' ' . session()->get('nom')) ?>
            </div>
            <div class="user-role"><?= esc(session()->get('role')) ?> · IT</div>
            </div>
        </div>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
        <div>
            <div class="topbar-title">Tableau de bord</div>
            <div class="topbar-breadcrumb">Accueil</div>
        </div>
        <div class="topbar-actions">
            <a href="/employe/create" class="btn-forest" style="padding:7px 14px;font-size:.82rem">
            <i class="bi bi-plus-lg"></i> Nouvelle demande
            </a>
        </div>
        </div>

        <div class="content">

        <!-- Flash succès -->
        <div class="flash flash-success">
            <i class="bi bi-check-circle-fill"></i>
            Votre demande de congé a bien été soumise. Elle est en attente de validation.
        </div>

        <!-- Métriques -->
        <div class="metrics">
            <div class="metric">
            <div class="metric-top"><div class="metric-icon mi-amber"><i class="bi bi-hourglass-split"></i></div></div>
            <div class="metric-val"><?= $attente ?></div>
            <div class="metric-label">En attente</div>
            </div>
            <div class="metric">
            <div class="metric-top"><div class="metric-icon mi-green"><i class="bi bi-check-circle"></i></div></div>
            <div class="metric-val"><?= $approuvee ?></div>
            <div class="metric-label">Approuvées</div>
            </div>
            <div class="metric">
            <div class="metric-top"><div class="metric-icon mi-forest"><i class="bi bi-calendar-check"></i></div></div>
            <div class="metric-val"><?= $joursRestants ?></div>
            <div class="metric-label">Jours restants</div>
            <div class="metric-sub">sur 30 cette année</div>
            </div>
            <div class="metric">
            <div class="metric-top"><div class="metric-icon mi-red"><i class="bi bi-x-circle"></i></div></div>
            <div class="metric-val"><?= $refusee ?></div>
            <div class="metric-label">Refusée</div>
            </div>
        </div>

        <!-- Soldes de congés -->
        <div class="data-card">
            <div class="data-card-head"><h3>Mes soldes de congés — 2025</h3></div>
            <div style="padding:1rem 1.25rem;display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem">
            <?php foreach ($soldes as $solde) { ?>
                <div class="solde-card" style="margin:0">
                    <div class="solde-header">
                        <span class="solde-type">
                            <?= esc($solde['libelle']) ?>
                        </span>
                    <span class="solde-nums">
                        <strong><?= $solde['jours_attribues'] - $solde['jours_pris'] ?></strong>
                         / <?= $solde['jours_attribues'] ?> j
                    </span>
                     <?php
                        $restant = $solde['jours_attribues'] - $solde['jours_pris'];
                        $percent = ($solde['jours_pris'] / $solde['jours_attribues']) * 100;
                    ?>
                    </div>
                    <div class="solde-bar"><div class="solde-fill" style="width:<?= $percent ?>%"></div></div>
                    <div class="solde-label">
                        <?= $restant ?> jours restants · <?= $solde['jours_pris'] ?> pris
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Dernières demandes -->
        <div class="data-card">
            <div class="data-card-head">
            <h3>Mes dernières demandes</h3>
            <a href="#page-mes-conges" style="font-size:.8rem;color:var(--forest);text-decoration:none">Voir tout →</a>
            </div>
            <table class="tbl">
            <thead>
                <tr><th>Type</th><th>Du</th><th>Au</th><th>Durée</th><th>Statut</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $d) { ?>
                <tr>
                <td><span class="type-badge t-annuel"><?= esc($d['libelle']) ?></span></td>
                <td class="td-muted"><?= esc($d['date_debut']) ?></td>
                <td class="td-muted"><?= esc($d['date_fin']) ?></td>
                <td class="td-mono"><?= $d['nb_jours'] ?> j</td>
                <td><span class="statut s-attente"><?= esc($d['statut']) ?></span></td>
                <td><button class="btn-sm btn-cancel"><i class="bi bi-x"></i> Annuler</button></td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>

        </div>
        <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span> — Projet CodeIgniter 4</div>
    </div>

    </div>
    </section>

</body>