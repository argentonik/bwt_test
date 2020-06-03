<?php

require_once './models/User.php';

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
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $birthday = $_POST['birthday'];

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
        $errors = array(
            'firstName' => null,
            'email' => null,
            'hasErrors' => false
        );

        if (!User::isValidName(trim($_POST['firstName']))) {
            $errors['firstName'] = 'Имя должно быть не короче 2 символов';
            $errors['hasErrors'] = true;
        }
        if (!User::isValidEmail($_POST['email'])) {
            $errors['email'] = 'Введите корректный email';
            $errors['hasErrors'] = true;
        } else {
            if (User::checkUserData($_POST['firstName'], $_POST['email']) === false) {
                $errors['email'] = 'Пользователя с таким именем или email не существует';
                $errors['hasErrors'] = true;
            }
        }
        return $errors;
    }

    private function isValidRegistrationForm()
    {
        $errors = array(
            'firstName' => null,
            'lastName' => null,
            'email' => null,
            'birthday' => null,
            'hasErrors' => false
        );

        if (!User::isValidName(trim($_POST['firstName']))) {
            $errors['firstName'] = 'Имя должно быть не короче 2 символов';
            $errors['hasErrors'] = true;
        }
        if (!User::isValidName(trim($_POST['lastName']))) {
            $errors['lastName'] = 'Фамилия должна быть не короче 2 символов';
            $errors['hasErrors'] = true;
        }
        if (!User::isValidEmail($_POST['email'])) {
            $errors['email'] = 'Введите корректный email';
            $errors['hasErrors'] = true;
        }
        if (User::isEmailExists($_POST['email'])) {
            $errors['email'] = 'Такой email уже существует';
            $errors['hasErrors'] = true;
        }
        if (!User::isValidDate($birthday = $_POST['birthday'])) {
            $errors['birthday'] = 'Введите дату в формате дд.мм.гггг';
            $errors['hasErrors'] = true;
        }

        return $errors;
    }
}