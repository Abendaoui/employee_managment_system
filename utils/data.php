<?php
$pages = array(
    array(
        'page' => 'Tableau de bord', 'link' => 'dashboard.php',
        'icon' => 'bx bx-home-circle',
        'keys' => ['dashboard.php']
    ),
    array(
        'page' => 'Mon horaire de travail', 'link' => 'my_work_schedule.php',
        'icon' => 'bx bx-calendar',
        'keys' => ['my_work_schedule.php']
    ),
    array(
        'page' => 'Gestion des congés', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-time', 'submenus' => array(
            array('page' => 'Faire une requête', 'link' => 'request.php'),
            array('page' => 'Historique des demandes', 'link' => 'request_history.php'),
        ),
        'keys' => ['request.php', 'request_history.php']
    ),
    array(
        'page' => 'Contrats', 'link' => 'contracts.php',
        'icon' => 'bx bx-file',
        'keys' => ['contracts.php']
    ),
    array(
        'page' => 'Départements', 'link' => 'departments.php',
        'icon' => 'bx bx-building',
        'keys' => ['departments.php']
    ),
    array(
        'page' => 'Rapports', 'link' => 'javascript:void(0);',
        'icon' => 'bx bxs-report', 'submenus' => array(
            array('page' => 'Envoyer un rapport', 'link' => 'send.php'),
            array('page' => 'Historique des rapports', 'link' => 'send_history.php'),
        ),
        'keys' => ['send.php', 'send_history.php']
    ),
    array(
        'page' => 'Formation', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-book', 'submenus' => array(
            array('page' => 'Liste de Formations', 'link' => 'list_formations.php'),
        ),
        'keys' => ['list_formations.php', 'formation_details.php']
    ),
);
$admin_pages = array(
    array(
        'page' => 'Tableau de bord', 'link' => 'dashboard.php',
        'icon' => 'bx bx-home-circle',
        'keys' => ['dashboard.php']
    ),
    array(
        'page' => 'Gestionnaires', 'link' => 'javascript:void(0);', 'icon' => 'bx bx-user-circle',
        'keys' => ['add_manager.php', 'list_managers.php'], 'submenus' => array(
            array('page' => 'Ajouter un gestionnaire', 'link' => 'add_manager.php'),
            array('page' => 'Liste des gestionnaires', 'link' => 'list_managers.php'),
        )
    ),
    array(
        'page' => 'Employés', 'link' => 'javascript:void(0);', 'icon' => 'bx bx-user', 'keys' => ['add_employee.php', 'list_employee.php'], 'submenus' => array(
            array('page' => 'Ajouter un employé', 'link' => 'add_employee.php'),
            array('page' => 'Liste des employés', 'link' => 'list_employee.php'),
        )
    ),
    array(
        'page' => 'Horaire de travail', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-calendar', 'keys' => ['work_schedule.php'],
        'submenus' => array(
            ['page' => 'Attribuer un horaire de travail', 'link' => 'assign_work_schedule.php'],
            ['page' => 'Afficher le programme de travail', 'link' => 'dispaly_Work_schedule.php'],
        ),
        'keys' => ['assign_work_schedule.php', 'dispaly_Work_schedule.php']
    ),
    array(
        'page' => 'Gestion des congés', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-time', 'keys' => ['request.php', 'request_history.php'],
        'submenus' => array(
            array('page' => 'Requêtes reçues', 'link' => 'received_request.php'),
            array('page' => 'Historique des demandes des employés', 'link' => 'request_history.php'),
        ),
        'keys' => ['request_history.php', 'received_request.php', 'request_details.php']
    ),
    array(
        'page' => 'Contrats', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-file', 'submenus' => array(
            array('page' => 'Ajouter un contrat', 'link' => 'add_contract.php'),
            array('page' => 'Liste des contrats', 'link' => 'list_contract.php'),
        ),
        'keys' => ['add_contract.php', 'list_contract.php', 'contract_details.php']
    ),
    array(
        'page' => 'Départements', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-building', 'submenus' => array(
            array('page' => 'Ajouter des départements', 'link' => 'add_dep.php'),
            array('page' => 'Liste des départements', 'link' => 'list_dep.php'),
        ),
        'keys' => ['add_dep.php', 'list_dep.php','edit_dep.php']
    ),
    array(
        'page' => 'Rapports', 'link' => 'javascript:void(0);',
        'icon' => 'bx bxs-report',
        'submenus' => array(
            array('page' => 'Envoyer un rapport', 'link' => 'send_report.php'),
            array('page' => 'Historique des rapports', 'link' => 'report_history.php'),
        ),
        'keys' => ['send_report.php', 'report_history.php']
    ),
    array(
        'page' => 'Formation', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-book', 'submenus' => array(
            array('page' => 'Ajouter une formation', 'link' => 'add_formations.php'),
            array('page' => 'Liste De Formation', 'link' => 'list_formations.php'),

        ),
        'keys' => ['list_formations.php', 'formation_details.php', 'add_formations.php']
    ),
);
