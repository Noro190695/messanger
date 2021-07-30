<?php


namespace app\controllers;



use app\models\Login;

class LoginController {

    public function indexAction() {
        dump(111);
        if (!empty($_POST)){

             Login::login($_POST);
        }
    }
    public function logoutAction() {
       unset( $_SESSION['user']);
       header("Location: /");
    }
}