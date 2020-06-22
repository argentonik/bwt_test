<?php

namespace models;

use core\Model;
use \PDO;

class Feedback extends Model
{
    public function save($firstName, $email, $report) {
        $sql = 'INSERT INTO feedbacks (date, firstName, email, report) '
            . 'VALUES (:date, :firstName, :email, :report)';

        $date = date('Y-m-d');

        $result = $this->db->prepare($sql);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':report', $report, PDO::PARAM_STR);

        $r = $result->execute();

        return $r;
    }

    public function getList($limit, $offset) {
        $feedbacksList = array();

        $result = $this->db->query('SELECT id, date, firstName, email, report '
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

    public function getTotalCount() {
        $result = $this->db->query('SELECT count(id) AS count FROM feedbacks');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public function hasErrorsReport($report) {
        if (!$report || mb_strlen($report) < 10) {
            return 'Длина отзыва должна быть больше 10 символов';
        } else if (mb_strlen($report) > 500) {
            return 'Длина отзыва должна быть не больше 500 символов';
        }
        return false;
    }
}