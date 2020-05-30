<?php


class RegistrationController
{
    public function actionIndex()
    {
        require_once('./views/registration/index.php');
        return true;
    }
}