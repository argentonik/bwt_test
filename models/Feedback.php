<?php


class Feedback
{
    public static function saveFeedback($firstName, $email, $report) {
        $db = Db::getConnection();
        $sql = 'INSERT INTO feedbacks (date, firstName, email, report) '
            . 'VALUES (:date, :firstName, :email, :report)';

        $date = date('Y-m-d');

        $result = $db->prepare($sql);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':report', $report, PDO::PARAM_STR);

        $r = $result->execute();

        return $r;
    }

    public static function getFeedbacksList($limit, $offset) {
        $db = Db::getConnection();

        $feedbacksList = array();

        $result = $db->query('SELECT id, date, firstName, email, report '
            . 'FROM feedbacks '
            . 'ORDER BY id DESC '
            . 'LIMIT '.$limit.' '
            . 'OFFSET '.($offset - 1) * $limit);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while($row = $result->fetch()) {
            $feedbacksList[$i]['date'] = $row['date'];
            $feedbacksList[$i]['firstName'] = $row['firstName'];
            $feedbacksList[$i]['email'] = $row['email'];
            $feedbacksList[$i]['report'] = $row['report'];
            $i++;
        }

        return $feedbacksList;
    }

    public static function getTotalCountOfFeedbacks() {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM feedbacks');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function hasErrorsReport($report) {
        if (!$report || mb_strlen($report) < 10) {
            return 'Длина отзыва должна быть больше 10 символов';
        } else if (mb_strlen($report) > 500) {
            return 'Длина отзыва должна быть не больше 500 символов';
        }
        return false;
    }
}