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
            