<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechMada RH — Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <script src="<?= base_url('js/app.js') ?>"></script>
    <script src="<?= base_url('js/index.global.min.js') ?>"></script>

    <!-- CSS FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        #calendar {
            max-width: 1000px;
            margin: 0 auto;
        }
    </style>
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
        <li><a href="/employe/calendar"><i class="bi bi-calendar3"></i> Calendrier </a></li>
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
                <div class="topbar-title"> Mon calendrier </div>
                <div class="topbar-breadcrumb">Accedez au calendrier soulignant vos conges</div>
            </div>
        </div>

        <div class="content" style="background-color: #ffffff; margin-top: 1rem; padding: 1.5rem;">
            <div id="calendar"></div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const calendarEl = document.getElementById('calendar');

                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'fr',

                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },

                        events: [
                            {
                                title: 'Réunion équipe',
                                start: '2026-05-20T10:00:00',
                                end: '2026-05-20T12:00:00'
                            },
                            {
                                title: 'Cours JavaScript',
                                start: '2026-05-22T14:00:00',
                                end: '2026-05-22T16:30:00'
                            },
                            {
                                title: 'Conférence IA',
                                start: '2026-05-25',
                                allDay: true
                            }
                        ]
                    });

                    calendar.render();
                });
            </script>
        </div>
    </div>

    </div>
    </section>

</body>
</html>