<?php


namespace app\controllers;

use core\base\views\Views;


class MainController {

    public function indexAction() {
        if (isset($_SESSION['user'])){
            echo json_encode([
                'status' => true,
                'user' => $_SESSION['user']
            ]);
        }else{
            echo json_encode(['status' => false]);
        }

    }
}