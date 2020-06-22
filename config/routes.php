<?php

return array(
    'registration' => '/user/register',
    'signIn' => '/user/signIn',
    'logout' => '/user/logout',

    'feedback/create' => '/feedback/create',
    'feedback/page-([0-9]+)' => '/feedback/view/$1',
    'feedback' => '/feedback/view',

    '' => '/weather/view'
);