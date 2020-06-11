<?php

require_once 'vendor/autoload.php';

require_once './models/Feedback.php';
require_once './components/Pagination.php';

use \ReCaptcha\ReCaptcha;

class FeedbacksController
{
    private $secret = '6LeYCQAVAAAAAGKrC2BA14fQJmGZFoADB10uSj_b';

    public function actionView($page = 1)
    {
        $feedbacks = Feedback::getFeedbacksList(3, $page);

        $total = Feedback::getTotalCountOfFeedbacks();

        $pagination = new Pagination($total, $page, 3, 'page-');

        require_once('./views/feedbacks/view.php');
        return true;
    }

    public function actionCreate() {
        $firstName = '';
        $email = '';
        $report = '';

        $isSendReport = false;
        $errors = null;

        if (isset($_POST['submit'])) {
            $firstName = trim($_POST['firstName']);
            $email = trim($_POST['email']);
            $report = trim($_POST['report']);

            $errors = $this->isValidFeedbackForm();

            if (!$errors['hasErrors']) {
                $isSendReport = Feedback::saveFeedback($firstName, $email, $report);
            }
        }
        if ($isSendReport) {
            require_once('./views/feedbacks/success.php');
        } else {
            require_once('./views/feedbacks/create.php');
        }
        return true;
    }

    private function isValidFeedbackForm() {
        $errors['firstName'] = User::hasErrorsFirstName($_POST['firstName']);
        $errors['email'] = User::hasErrorsEmail($_POST['email']);
        $errors['report'] = Feedback::hasErrorsReport($_POST['report']);
        $errors['recaptcha'] = $this->hasErrorsRecaptcha();

        $errors['hasErrors'] = $errors['firstName'] || $errors['email'] || $errors['report'] || $errors['recaptcha'];

        return $errors;
    }

    private function hasErrorsRecaptcha() {
        $gRecaptchaResponse = $_POST["g-recaptcha-response"];

        $recaptcha = new ReCaptcha($this->secret);
        $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
            ->verify($gRecaptchaResponse,  $_SERVER["REMOTE_ADDR"]);

        return $resp->isSuccess() ? false : 'reCAPTCHA не пройдена';
    }
}