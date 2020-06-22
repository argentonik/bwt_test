<?php

return array(
    'user' => [
        'register' => 'all',
        'signIn' => 'all',
        'logout' => 'authorize'
    ],
    'feedback' => [
        'create' => 'all',
        'view' => 'authorize'
    ],
    'weather' => [
        'view' => 'authorize'
    ]
);