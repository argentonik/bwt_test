<?php

return array(
    'registration' => '/user/register',
    'signIn' => '/user/signIn',
    'logout' => '/user/logout',

    'feedbacks/create' => '/feedbacks/create',
    'feedbacks/page-([0-9]+)' => '/feedbacks/view/$1',
    'feedbacks' => '/feedbacks/view',

    '' => '/weather/view'
);