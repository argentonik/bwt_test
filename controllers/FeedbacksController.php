<?php


class FeedbacksController
{
    public function actionView()
    {
        require_once('./views/feedbacks/view.php');
        return true;
    }

    public function actionCreate() {
        require_once('./views/feedbacks/create.php');
        return true;
    }
}