<?php
/**
 * define aliases to map your model information to
 * the roles defined in your role configuration.
 */
$config['alias'] = array(
    'Role/0' => 'Role/Guest',
    'Role/4' => 'Role/Admin',
    'Role/5' => 'Role/Teacher',
    'Role/6' => 'Role/Pupil',
);

/**
 * role configuration
 */
$config['roles'] = array(
    'Role/Guest' => null,
    'Role/LoggedIn' => null,
    'Role/Admin' => 'Role/LoggedIn',
    'Role/Teacher' => 'Role/LoggedIn',
    'Role/Pupil' => 'Role/LoggedIn',
);

/**
 * rule configuration
 */
$config['rules'] = array(
    'allow' => array(
        'controllers/users/login' => 'Role/Guest',
        'controllers/users/register' => 'Role/Guest',
        
        'controllers/users/logout' => 'Role/LoggedIn',
        
        'controllers/pages/display' => 'Role/LoggedIn, Role/Guest',
        'controllers/users/current' => 'Role/LoggedIn, Role/Guest',
        
        '*' => 'Role/Admin',
        
        'controllers/lessons/' => 'Role/Teacher',
        'controllers/answers/' => 'Role/Teacher',
        'controllers/groups/' => 'Role/Teacher',
        'controllers/users/' => 'Role/Teacher',
        'controllers/images/' => 'Role/Teacher',
        'controllers/presentations/' => 'Role/Teacher',
        
        'controllers/lessons/index' => 'Role/Pupil',
        'controllers/lessons/view' => 'Role/Pupil',
        'controllers/answers/viewMy' => 'Role/Pupil',
        'controllers/answers/saveMy' => 'Role/Pupil',
    ),
    'deny' => array(
    ),
);
