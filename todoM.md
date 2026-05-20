# Projet TechMada

## Implementation de la template
- Pages
    - [ok] auth/login.php
        - [ok] delimiter la partie login dans le fichier html
        - [ok] copier et coller
        - [ok] modifier les routes
        - [ok] tester

    - Partie employe
        - [ok] employe/dashboard.php
            - [ok] delimiter la partie dashboard
            - [ok] copier et coller
            - [ok] ajouter la route

        - [ok] employe/create.php
            - [ok] delimiter la partie create
            - [ok] copier et coller
            - [ok] ajouter la route

        - [ok] employe/index.php
            - [ok] delimiter la partie index
            - [ok] copier et coller
            - [ok] ajouter la route

    - Partie RH
        - [ok] rh/index.php
            - [ok] delimiter la partie index
            - [ok] copier et coller
            - [ok] ajouter la route

    - Partie admin
        - [ok] admin/dashboard.php
            - [ok] delimiter la partie dashboard
            - [ok] copier et coller
            - [ok] ajouter la route

        - [ok] admin/employes.php
            - [ok] delimiter la partie employes
            - [ok] copier et coller
            - [ok] ajouter la route


    - General
        - [ok] Creer css/style.css
        - [ok] Mettre <style> dans style.css
        - [ok] Creer js/app.js
        - [ok] Mettre <script> dans app.js
        - <script src="<?= base_url('js/app.js') ?>"></script>Rajouter les liens css et js dans les pages

- Creation des controllers
    - [ok] EmployeController
        - [ok] dashboard()
            - retourne vers employe/dashboard
        - [ok] create()
            - retoutne vers employe/create
        - [ok] index()
            - retoutne vers employe/index
    - [ok] RhController
        - [ok] index()
            - retoutne vers rh/index
    - [ok] AdminController
        - [ok] dashboard()
            - retourne vers admin/dashboard
        - [ok] employes()
            - retourne vers admin/employes
            
    
## Espace employe
### dashboard
- Models
    - [ok] EmployeModel.php
        - table
        - primaryKey
        - allowedFields

    - [ok] CongeModel.php
        - table
        - primaryKey
        - allowedFields
        - timestamps
        - methodes
            - compteur par statut
            - prendre derniere demande
            - prendre toutes les demandes

    - [ok] SoldeModel.php
        - table
        - primaryKey
        - allowedFields
        - methodes
            - getSolde par employe
            - get jours restants total


- Controllers
    - [ok] EmployeController.php
        - fonction dashboard
            [ok] prendre session
            [ok] prendre les attentes, approbations,refus
            [ok] pendre les soldes
            [ok] prendre les demandes

- View
    [ok] rendre la vue dynamique

    
### create

- Models
    - [ok] TypeCongeModel.php
        - table
        - primaryKey
        - allowedFields
        - methodes
            - prendre tous les types de congé

- Controllers
    - [ok] EmployeController.php
        - [ok] fonction create
            - prendre session
            - prendre types de congé
            - prendre soldes employé
            - retourner vue create

        - [ok] fonction store
            - validation formulaire
            - calcul nombre de jours
            - insertion demande congé
            - statut en_attente par défaut
            - redirect + flash message

- Routes
    - [ok] employe/store

- View
    - [ok] rendre le formulaire dynamique
        - select types de congé dynamique
        - soldes dynamiques
        - erreurs validation CI4
        - formulaire POST
        - affichage ancien input

    - [ok] calcul dynamique
        - nombre de jours demandés
        - pourcentage soldes

### index (Mes demandes)
- Models
    - [ok] CongeModel.php
        - methodes
            - getByEmploye(id)
            - join avec types_conge
            - tri par date DESC

    - [ok] TypeCongeModel.php
        - utilisé pour libellé (optionnel si join)

- Controllers
    - [ok]  EmployeController.php
        - [ok] fonction index()
            - prendre session user_id
            - récupérer toutes les demandes de congé
            - join types_conge
            - envoyer vers vue

        - [ok] fonction cancel()
            - vérifier statut = en_attente uniquement
            - update statut = annulée
            - redirect avec message flash

- Routes
    - [ok] employe/cancel/{id}

- View
    - [ok] employe/index.php
        - liste des demandes depuis DB
        - affichage statut dynamique
        - affichage commentaire RH dynamique
        - bouton annuler conditionnel (si en_attente)




## Suite
- Cote Employe
    - Vue calendrier: afficher les conges sous forme de calendrier hebdomadaire interactif.
        - CongeModel
            - [ok] Foncion getByEmploye($idEmploye)
        - EmployeController
            - creer fonction calendar()
                - [ok] appeler la fonction getByEmploye(Session['id])
                - [ok] Creer un tableau event avec comme colonne:
                    - title: motif dans table
                    - start: date_debut dans table
                    - end: date_fin dans table
                - [ok] mettre dans un tableau de meme format que celui dans calendar.html
                - [ok] rajouter le tableau dans data I guess
                - [ok] retourner vers calendar.php avec data
        - Routes.php
            - [ok] rajouter une route dans le groupe employe
                get('calendar, 'EmployeController::calendar')
        - calendar.php
            - ctrl+c et ctrl+v ce dont on a besoin dans calendar.html
            - boucler le tableau precedemment cree au lieu de faire le js

            - telecharger le script et le css index.global.min.x pour que ce soit fonctionnel offline
        - global
            - [ok] rajouter dans le navbar "Calendrier" avec comme lien /calendar
