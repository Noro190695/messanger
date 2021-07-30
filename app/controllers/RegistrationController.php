<?php


namespace app\controllers;


use app\models\Registration;

class RegistrationController {
    public function indexAction() {

        if (!empty($_POST)){
            Registration::create($_POST);
        }

    }
}