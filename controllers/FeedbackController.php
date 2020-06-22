<?php

namespace controllers;

use core\Controller;
use components\Pagination;
use \ReCaptcha\ReCaptcha;

class FeedbackController extends Controller
{
    private $secret = '6LeYCQAVAAAAAGKrC2BA14fQJmGZFoADB10uSj_b';

    public function __construct($route) {
		parent::__construct($route);
	}

    public function actionView($page = 1)
    {
        $feedbacks = $this->model->getList(3, $page);
        $total = $this->model->getTotalCount();

        $viewVars = [
            'feedbacks' => $feedbacks,
            'pagination' => new Pagination($total, $page, 3, 'page-')
        ];

        $this->view->render($viewVars);
        return true;
    }

    public function actionCreate() {
        $viewVars = [
            'firstName' => '',
            'email' => '',
            'report' => '',
            'errors' => null
        ];

        $isSendReport = false;

        if (isset($_POST['submit'])) {
            $viewVars['firstName'] = trim($_POST['firstName']);
            $viewVars['email'] = trim($_POST['email']);
            $viewVars['report'] = trim($_POST['report']);

            $viewVars['errors'] = $this->isValidFeedbackForm();

            if (!$viewVars['errors']['hasErrors']) {
                $isSendReport = $this->model->save($viewVars['firstName'], 
                    $viewVars['email'], $viewVars['report']);
            }
        }
        if ($isSendReport) {
            $this->view->renderFile('feedback/success.php');
        } else {
            $this->view->render($viewVars);
        }
        return true;
    }

    private function isValidFeedbackForm() {
        $errors['firstName'] = $this->user->hasErrorsFirstName($_POST['firstName']);
        $errors['email'] = $this->user->hasErrorsEmail($_POST['email']);
        $errors['report'] = $this->model->hasErrorsReport($_POST['report']);
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