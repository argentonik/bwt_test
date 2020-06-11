<?php

class UserController
{
    public function actionRegister()
    {
        $firstName = '';
        $lastName = '';
        $email = '';
        $gender = '';
        $birthday = '';

        $registered = false;
        $errors = null;

        if (isset($_POST['submit'])) {
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $email = trim($_POST['email']);
            $gender = trim($_POST['gender']);
            $birthday = trim($_POST['birthday']);

            $errors = $this->isValidRegistrationForm();

            if (!$errors['hasErrors']) {
                $registered = User::register($firstName, $lastName, $email,
                    $gender, $birthday);
            }
        }
        if ($registered) {
            header("Location: http://{$_SERVER['SERVER_NAME']}");
            exit();
        } else {
            require_once('./views/users/registration.php');
        }
        return true;
    }

    public function actionSignIn()
    {
        $firstName = '';
        $email = '';
        $errors = null;

        if (isset($_POST['submit'])) {
            $firstName = $_POST['firstName'];
            $email = $_POST['email'];

            $errors = $this->isValidSignInForm();

            if (!$errors['hasErrors']) {
                $user = User::checkUserData($firstName, $email);
                User::auth($user);
                header("Location: http://{$_SERVER['SERVER_NAME']}");
            }
        }
        require_once('./views/users/signIn.php');
        return true;
    }

    public function actionLogout() {
        session_start();
        unset($_SESSION['user']);
        header("Location: http://{$_SERVER['SERVER_NAME']}");
    }

    private function isValidSignInForm() {
        $errors['firstName'] = User::hasErrorsFirstName($_POST['firstName']);
        $errors['email'] = User::hasErrorsEmail($_POST['email']);

        if (User::checkUserData($_POST['firstName'], $_POST['email']) === false) {
            $errors['email'] = 'Пользователя с таким именем или email не существует';
        }

        $errors['hasErrors'] = $errors['firstName'] || $errors['email'];

        return $errors;
    }

    private function isValidRegistrationForm()
    {
        $errors['firstName'] = User::hasErrorsFirstName($_POST['firstName']);
        $errors['lastName'] = User::hasErrorsLastName($_POST['lastName']);
        $errors['email'] = User::hasErrorsEmail($_POST['email']);
        $errors['birthday'] = User::hasErrorsDate($_POST['birthday']);

        if (User::isEmailExists($_POST['email'])) {
            $errors['email'] = 'Такой email уже существует';
        }

        $errors['hasErrors'] = $errors['firstName'] || $errors['lastName'] ||
            $errors['email'] || $errors['birthday'];

        return $errors;
    }
}