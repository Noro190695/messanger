<?php


namespace app\models;


use core\base\models\BaseModel;

class Login extends BaseModel {
    public static function login($data){
        $pdo = self::connection();
        $validation = self::validation($data);
        if ($validation['status']){
            $stmt = $pdo->prepare("SELECT * FROM users WHERE `email`=:email");
            $stmt->execute(['email' => $data['email']]);
            $userCount = $stmt->rowCount();
            if ($userCount){
                $user = $stmt->fetch();
                $password_verification = password_verify($data['password'], $user['password']);
                if ($password_verification){
                    $_SESSION['user'] = [
                        'fullName' => $user['full_name'],
                        'email' => $user['email'],
                        'createdAt' => $user['created_at']

                    ];
                    header('Location: https://bewedoc.ru');

                }else{
                    echo json_encode([
                        'status' => false,
                        'message' => 'wrong password'
                    ]);
                }
            }else{
                echo json_encode([
                    'status' => false,
                    'message' => 'wrong mail'
                ]);
            }
        }else{
            echo json_encode($validation);
        }

    }
    private static function validation($data){

        $error = false;
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $error = 'Invalid format email';
        }elseif (strlen($data['password']) < 6 ) {
            $error = 'password must be more than 6 characters';
        }
        if ($error){
            return [
                'status' => false,
                'message' => $error
            ];
        }else{
            return [
                'status' => true
            ];
        }
    }

}