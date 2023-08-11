<?php
$pages = array(
    array(
        'page' => 'Dashboard', 'link' => 'dashboard.php',
        'icon' => 'bx bx-home-circle',
        'keys' => ['dashboard.php']
    ),
    array(
        'page' => 'My Work Schedule', 'link' => 'my_work_schedule.php',
        'icon' => 'bx bx-calendar',
        'keys' => ['my_work_schedule.php']
    ),
    array(
        'page' => 'Leave Management', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-time', 'submenus' => array(
            array('page' => 'Make Request', 'link' => 'request.php'),
            array('page' => 'Request History', 'link' => 'request_history.php'),
        ),
        'keys' => ['request.php', 'request_history.php']
    ),
    array(
        'page' => 'Contracts', 'link' => 'contracts.php',
        'icon' => 'bx bx-file',
        'keys' => ['contracts.php']
    ),
    array(
        'page' => 'Departments', 'link' => 'departments.php',
        'icon' => 'bx bx-building',
        'keys' => ['departments.php']
    ),
    array(
        'page' => 'Reports', 'link' => 'javascript:void(0);',
        'icon' => 'bx bxs-report', 'submenus' => array(
            array('page' => 'Send Report', 'link' => 'send.php'),
            array('page' => 'Reports History', 'link' => 'send_history.php'),
        ),
        'keys' => ['send.php', 'send_history.php']
    ),
    array(
        'page' => 'Formation', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-book', 'submenus' => array(
            array('page' => 'List Formation', 'link' => 'list_formations.php'),
        ),
        'keys' => ['list_formations.php', 'formation_details.php']
    ),
);
$admin_pages = array(
    array(
        'page' => 'Dashboard', 'link' => 'dashboard.php',
        'icon' => 'bx bx-home-circle',
        'keys' => ['dashboard.php']
    ),
    array(
        'page' => 'Managers', 'link' => 'javascript:void(0);', 'icon' => 'bx bx-user-circle',
        'keys' => ['add_manager.php', 'list_managers.php'], 'submenus' => array(
            array('page' => 'Add Manager', 'link' => 'add_manager.php'),
            array('page' => 'List Of Managers', 'link' => 'list_managers.php'),
        )
    ),
    array(
        'page' => 'Employees', 'link' => 'javascript:void(0);', 'icon' => 'bx bx-user', 'keys' => ['add_employee.php', 'list_employee.php'], 'submenus' => array(
            array('page' => 'Add Employee', 'link' => 'add_employee.php'),
            array('page' => 'List Of Employees', 'link' => 'list_employee.php'),
        )
    ),
    array(
        'page' => 'Work Schedule', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-calendar', 'keys' => ['work_schedule.php'],
        'submenus' => array(
            ['page' => 'Assign Work Schedule', 'link' => 'assign_work_schedule.php'],
            ['page' => 'Dispaly Work Schedule', 'link' => 'dispaly_Work_schedule.php'],
        ),
        'keys' => ['assign_work_schedule.php', 'dispaly_Work_schedule.php']
    ),
    array(
        'page' => 'Leave Management', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-time', 'keys' => ['request.php', 'request_history.php'],
        'submenus' => array(
            array('page' => 'Received Requsets', 'link' => 'received_request.php'),
            array('page' => 'Employees Request History', 'link' => 'request_history.php'),
        ),
        'keys' => ['request_history.php', 'received_request.php', 'request_details.php']
    ),
    array(
        'page' => 'Contracts', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-file', 'submenus' => array(
            array('page' => 'Add Contract', 'link' => 'add_contract.php'),
            array('page' => 'List Of Contracts', 'link' => 'list_contract.php'),
        ),
        'keys' => ['add_contract.php', 'list_contract.php', 'contract_details.php']
    ),
    array(
        'page' => 'Departments', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-building', 'submenus' => array(
            array('page' => 'Add Departments', 'link' => 'add_dep.php'),
            array('page' => 'List Of Departments', 'link' => 'list_dep.php'),
        ),
        'keys' => ['add_dep.php', 'list_dep.php']
    ),
    array(
        'page' => 'Reports', 'link' => 'javascript:void(0);',
        'icon' => 'bx bxs-report',
        'submenus' => array(
            array('page' => 'Send Report', 'link' => 'send_report.php'),
            array('page' => 'Reports History', 'link' => 'report_history.php'),
        ),
        'keys' => ['send_report.php', 'report_history.php']
    ),
    array(
        'page' => 'Formation', 'link' => 'javascript:void(0);',
        'icon' => 'bx bx-book', 'submenus' => array(
            array('page' => 'Add Formation', 'link' => 'add_formations.php'),
            array('page' => 'List Formation', 'link' => 'list_formations.php'),

        ),
        'keys' => ['list_formations.php', 'formation_details.php', 'add_formations.php']
    ),
);
