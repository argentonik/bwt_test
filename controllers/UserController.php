<?php

namespace controllers;

use core\Controller;

class UserController extends Controller
{
    public function __construct($route) {
        parent::__construct($route);
    }
    
    public function actionRegister()
    {
        $viewVars = [
            'firstName' => '',
            'lastName' => '',
            'email' => '',
            'gender' => '',
            'birthday' => '',
            'errors' => null
        ];

        $registered = false;

        if (isset($_POST['submit'])) {
            $viewVars['firstName'] = trim($_POST['firstName']);
            $viewVars['lastName'] = trim($_POST['lastName']);
            $viewVars['email'] = trim($_POST['email']);
            $viewVars['gender'] = trim($_POST['gender']);
            $viewVars['birthday'] = trim($_POST['birthday']);

            $viewVars['errors'] = $this->isValidRegistrationForm();

            if (!$viewVars['errors']['hasErrors']) {
                $registered = $this->model->register($viewVars['firstName'], 
                    $viewVars['lastName'], $viewVars['email'],
                    $viewVars['gender'], $viewVars['birthday']);
            }
        }
        if ($registered) {
            $this->view->redirect("http://{$_SERVER['SERVER_NAME']}");
        } else {
            $this->view->render($viewVars);
        }
        return true;
    }

    public function actionSignIn()
    {
        $viewVars = [
            'firstName' => '',
            'email' => '',
            'errors' => null
        ];

        if (isset($_POST['submit'])) {
            $viewVars['firstName'] = $_POST['firstName'];
            $viewVars['email'] = $_POST['email'];

            $viewVars['errors'] = $this->isValidSignInForm();

            if (!$viewVars['errors']['hasErrors']) {
                $user = $this->model->checkUserData($viewVars['firstName'], $viewVars['email']);
                $this->model->auth($user);
                $this->view->redirect("http://{$_SERVER['SERVER_NAME']}");
            }
        }
        $this->view->render($viewVars);
        return true;
    }

    public function actionLogout() {
        $this->user->logout();
        $this->view->redirect("http://{$_SERVER['SERVER_NAME']}");
    }

    private function isValidSignInForm() {
        $errors['firstName'] = $this->model->hasErrorsFirstName($_POST['firstName']);
        $errors['email'] = $this->model->hasErrorsEmail($_POST['email']);

        if ($this->model->checkUserData($_POST['firstName'], $_POST['email']) === false) {
            $errors['email'] = 'Пользователя с таким именем или email не существует';
        }

        $errors['hasErrors'] = $errors['firstName'] || $errors['email'];

        return $errors;
    }

    private function isValidRegistrationForm()
    {
        $errors['firstName'] = $this->model->hasErrorsFirstName($_POST['firstName']);
        $errors['lastName'] = $this->model->hasErrorsLastName($_POST['lastName']);
        $errors['email'] = $this->model->hasErrorsEmail($_POST['email']);
        $errors['birthday'] = $this->model->hasErrorsDate($_POST['birthday']);

        if ($this->model->isEmailExists($_POST['email'])) {
            $errors['email'] = 'Такой email уже существует';
        }

        $errors['hasErrors'] = $errors['firstName'] || $errors['lastName'] ||
            $errors['email'] || $errors['birthday'];

        return $errors;
    }
}