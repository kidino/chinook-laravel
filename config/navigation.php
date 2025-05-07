<?php

return [
    [
        'label' => 'Dashboard',
        'route' => 'dashboard',
        'icon' => 'home', // Optional, for icons
        'roles' => ['Admin'], // Roles allowed to see this menu
        'active' => 'dashboard', // Active rule
    ],
    [
        'label' => 'Chinook',
        'route' => 'chinook.dashboard',
        'icon' => 'user',
        'roles' => ['Admin', 'Manager', 'User'],
        'active' => 'chinook*', // Active rule
    ],
];