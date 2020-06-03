<?php


class User
{
    public static function register($firstName, $lastName, $email, $gender, $birthday) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO users (firstName, lastName, email, gender_id, birthday) '
            .'VALUES (:firstName, :lastName, :email, :gender_id, :birthday)';

        $genders = require_once('./models/Gender.php');

        $result = $db->prepare($sql);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':gender_id', $genders[$gender], PDO::PARAM_INT);
        $result->bindParam(':birthday', $birthday, PDO::PARAM_STR);

        $r = $result->execute();

        return $r;
    }

    public static function auth($user) {
        session_start();
        $_SESSION['user'] = $user;
    }

    public static function checkLogged() {
        if(!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function checkUserData($firstName, $email) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM users WHERE firstName = :firstName AND email = :email';

        $result = $db->prepare($sql);
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

    public static function isEmailExists($email) {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM users WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        return $result->fetchColumn() ? true : false;
    }

    public static function isValidName($name) {
        return $name && (mb_strlen($name) >= 2);
    }

    public static function isValidEmail($email) {
        return $email && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isValidDate($dateStr) {
        // format yyyy-mm-dd
        return $dateStr &&
            preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateStr);
    }
}