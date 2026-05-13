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
    <section id="page-admin-employes" style="margin-top:3rem">
    <div class="app-wrap">

    <aside class="sidebar">
        <div class="sidebar-brand">
        <div class="sidebar-logo-icon" style="background:var(--ink);border:1px solid rgba(255,255,255,.15)"><i class="bi bi-shield-check" style="color:var(--leaf)"></i></div>
        <div class="sidebar-brand-name">TechMada RH<span>Administration</span></div>
        </div>
        <ul class="sidebar-nav" style="margin-top:1rem">
        <li><a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> Vue d'ensemble</a></li>
        <li><a href="#page-liste-rh"><i class="bi bi-inbox"></i> Toutes les demandes</a></li>
        <li><a href="/admin/employes" class="active"><i class="bi bi-people"></i> Employés</a></li>
        <li><a href="#page-admin-employes"><i class="bi bi-building"></i> Départements</a></li>
        <li><a href="#page-admin-employes"><i class="bi bi-tags"></i> Types de congé</a></li>
        </ul>
        <div class="sidebar-user">
        <div class="s-user-row">
            <div class="avatar" style="background:#5a2d82;width:32px;height:32px;font-size:.7rem">AD</div>
            <div><div class="user-name">Administrateur</div><div class="user-role">Admin système</div></div>
        </div>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
        <div>
            <div class="topbar-title">Gestion des employés</div>
            <div class="topbar-breadcrumb"><a href="#page-dashboard-admin">Admin</a> <i class="bi bi-chevron-right" style="font-size:.6rem"></i> Employés</div>
        </div>
        <div class="topbar-actions">
            <a href="/admin/employes" class="btn-forest" style="padding:7px 14px;font-size:.82rem"><i class="bi bi-person-plus"></i> Nouveau</a>
        </div>
        </div>

        <div class="content">

        <!-- Messages flash -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Formulaire ajout/édition -->
        <div class="form-section">
            <h3><i class="bi bi-person-plus" style="color:var(--forest);margin-right:6px"></i><?= isset($edit_mode) && $edit_mode ? 'Modifier un employé' : 'Ajouter un employé' ?></h3>
            <form method="post" action="<?= isset($edit_mode) && $edit_mode ? base_url('admin/employes/update/' . $employe_edit['id']) : base_url('admin/employes/create') ?>">
                <?= csrf_field() ?>
                <div class="form-grid-2" style="margin-bottom:1rem">
                <div class="f-group">
                    <label class="f-label">Prénom</label>
                    <input type="text" name="prenom" class="f-input" placeholder="Jean" value="<?= isset($edit_mode) && $edit_mode ? $employe_edit['prenom'] : old('prenom') ?>"/>
                    <?php if (isset($errors) && isset($errors['prenom'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['prenom'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Nom</label>
                    <input type="text" name="nom" class="f-input" placeholder="Rakoto" value="<?= isset($edit_mode) && $edit_mode ? $employe_edit['nom'] : old('nom') ?>"/>
                    <?php if (isset($errors) && isset($errors['nom'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['nom'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Email</label>
                    <input type="email" name="email" class="f-input" placeholder="jean.rakoto@techmada.mg" value="<?= isset($edit_mode) && $edit_mode ? $employe_edit['email'] : old('email') ?>"/>
                    <?php if (isset($errors) && isset($errors['email'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Mot de passe <?= isset($edit_mode) && $edit_mode ? '(laisser vide pour conserver l\'actuel)' : 'initial' ?></label>
                    <input type="password" name="password" class="f-input" placeholder="<?= isset($edit_mode) && $edit_mode ? 'Nouveau mot de passe' : 'À communiquer à l\'employé' ?>"/>
                    <?php if (isset($errors) && isset($errors['password'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Département</label>
                    <select name="departement_id" class="f-select">
                        <?php if (isset($departements)): ?>
                            <?php foreach ($departements as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= isset($edit_mode) && $edit_mode && $employe_edit['departement_id'] == $dept['id'] ? 'selected' : '' ?>><?= $dept['nom'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <?php if (isset($errors) && isset($errors['departement_id'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['departement_id'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Rôle</label>
                    <select name="role" class="f-select">
                        <option value="employe" <?= isset($edit_mode) && $edit_mode && $employe_edit['role'] == 'employe' ? 'selected' : '' ?>>Employé</option>
                        <option value="rh" <?= isset($edit_mode) && $edit_mode && $employe_edit['role'] == 'rh' ? 'selected' : '' ?>>Responsable RH</option>
                        <option value="admin" <?= isset($edit_mode) && $edit_mode && $employe_edit['role'] == 'admin' ? 'selected' : '' ?>>Administrateur</option>
                    </select>
                    <?php if (isset($errors) && isset($errors['role'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['role'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="f-group">
                    <label class="f-label">Date d'embauche</label>
                    <input type="date" name="date_embauche" class="f-input" value="<?= isset($edit_mode) && $edit_mode ? $employe_edit['date_embauche'] : old('date_embauche', date('Y-m-d')) ?>"/>
                    <?php if (isset($errors) && isset($errors['date_embauche'])): ?>
                        <div class="text-danger" style="font-size:.75rem"><?= $errors['date_embauche'] ?></div>
                    <?php endif; ?>
                </div>
                </div>
                <div class="flash flash-info" style="margin-bottom:1rem">
                <i class="bi bi-info-circle-fill"></i>
                <span style="font-size:.82rem">Les soldes de congés seront initialisés automatiquement selon les types de congé configurés.</span>
                </div>
                <div class="form-actions">
                <button type="submit" class="btn-forest"><i class="bi bi-plus"></i> <?= isset($edit_mode) && $edit_mode ? 'Modifier' : 'Créer' ?> l'employé</button>
                <a href="/admin/employes" class="btn-secondary" style="border:none;cursor:pointer">Annuler</a>
                </div>
            </form>
        </div>

        <?php if (empty($employes) === false || !isset($edit_mode) || !$edit_mode): ?>
        <div class="data-card">
            <div class="data-card-head">
            <h3>Tous les employés</h3>
            <div style="display:flex;gap:6px">
                <input type="text" class="f-input" placeholder="Rechercher..." style="width:200px;padding:6px 10px;font-size:.8rem"/>
                <select class="f-select" style="font-size:.8rem;padding:6px 10px;width:auto">
                <option>Tous les depts</option>
                <option>IT</option>
                <option>Finance</option>
                </select>
            </div>
            </div>
            <table class="tbl">
            <thead>
                <tr><th>Employé</th><th>Département</th><th>Rôle</th><th>Embauche</th><th>Statut</th><th>Solde annuel</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $emp) { 
                    if ($emp['actif'] == 1) { 
                        $actif = 'actif'; ?>
                        <tr>
                    <?php } else { 
                        $actif = 'inactif'; ?>
                        <tr style="opacity:.5"> 
                    <?php } ?>
                        <td>
                            <div class="profile-row">
                                <div class="avatar av-green" style="width:32px;height:32px;font-size:.68rem">SR</div>
                                <div class="profile-info"><div class="pname"><?= $emp['nom'] . $emp['prenom'] ?></div><div class="pdept"><?= $emp['email']?></div></div>
                            </div>
                        </td>
                        <td class="td-muted"><?= $emp['departement']?></td>
                        <td><span class="type-badge" style="background:#f1efe8;color:#444441"><?= $emp['role']?></span></td>
                        <td class="td-muted td-mono" style="font-size:.78rem"><?= $emp['date_embauche']?></td>
                        <td><span class="statut s-approuvee" style="font-size:.68rem"><?= $actif?></span></td>
                        <td><span style="font-family:'DM Mono',monospace;font-size:.82rem;color:var(--forest)"> /  j</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="<?= base_url('admin/employes/edit/' . $emp['id']) ?>" class="btn-sm btn-edit"><i class="bi bi-pencil"></i> Éditer</a>
                                <a href="<?= base_url('admin/employes/deactivate/' . $emp['id']) ?>" class="btn-sm btn-del" onclick="return confirm('Êtes-vous sûr de vouloir désactiver cet employé ?')"><i class="bi bi-slash-circle"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
        <?php endif; ?>

        </div>
        <div class="footer-app"><i class="bi bi-c-circle"></i> 2025 <span>TechMada RH</span></div>
    </div>

    </div>
    </section>
</body>