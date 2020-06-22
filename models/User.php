<?php

namespace models;

use core\Model as Model;
use \PDO;

class User extends Model
{
    public function register($firstName, $lastName, $email, $gender, $birthday) {
        $sql = 'INSERT INTO users (firstName, lastName, email, gender_id, birthday) '
            .'VALUES (:firstName, :lastName, :email, :gender_id, :birthday)';

        $birthday = $birthday ? $birthday : null;

        $result = $this->db->prepare($sql);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':gender_id', $gender, PDO::PARAM_INT);
        $result->bindParam(':birthday', $birthday, PDO::PARAM_STR);

        $r = $result->execute();

        return $r;
    }

    public function auth($user) {
        session_start();
        $_SESSION['user'] = $user;
    }

    public function logout() {
        unset($_SESSION['user']);
    }

    public function checkLogged() {
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public function checkUserData($firstName, $email) {
        $sql = 'SELECT * FROM users WHERE firstName = :firstName AND email = :email';

        $result = $this->db->prepare($sql);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return array(
                'id' => $user['id'],
                'name' => $user['firstName']
            );
        }

        return false;
    }

    public function isEmailExists($email) {
        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $this->db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        return $result->fetchColumn() ? true : false;
    }

    public function hasErrorsFirstName($name) {
        if (!$name || mb_strlen($name) < 2) {
            return 'Имя должно быть не короче 2 символов';
        } else if (mb_strlen($name) > 20) {
            return 'Имя должно быть не длиннее 20 символов';
        }
        return false;
    }

    public function hasErrorsLastName($name) {
        if (!$name || mb_strlen($name) < 2) {
            return 'Фамилия должна быть не короче 2 символов';
        } else if (mb_strlen($name) > 20) {
            return 'Фамилия должна быть не длиннее 20 символов';
        }
        return false;
    }

    public function hasErrorsEmail($email) {
        return $email && filter_var($email, FILTER_VALIDATE_EMAIL) ? false : 'Введите корректный email';
    }

    public function hasErrorsDate($dateStr) {
        // format yyyy-mm-dd
        return !$dateStr ||
            ($dateStr && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateStr)) ? false :
            'Введите дату в формате дд.мм.гггг';
    }
}