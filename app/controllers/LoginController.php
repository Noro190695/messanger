<?php


namespace app\controllers;



use app\models\Login;

class LoginController {

    public function indexAction() {
        if (!empty($_POST)){
            dump(111);
             Login::login($_POST);
        }
    }
    public function logoutAction() {
       unset( $_SESSION['user']);
       header("Location: /");
    }
}