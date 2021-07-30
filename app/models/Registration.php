<?php


namespace app\models;


use core\base\models\BaseModel;

class Registration extends BaseModel {



    public static function create($data) {
        $pdo = self::connection();
        $validation = self::validation($data);
        if ($validation['status']){
            $dateTime = date("Y-m-d H:i:s");
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`full_name`, `email`, `password`, `created_at`) VALUES (?,?,?,?)";
            $stmt= $pdo->prepare($sql);
           $res =  $stmt->execute([$data['full_name'], $data['email'], $password, $dateTime]);
           if ($res){
               echo json_encode([
                   'status' => $res,
                   'message' => "user $data[full_name] created"
               ]);
           }else{
              echo json_encode([
                   'status' => $res
               ]);
           }
        }else{
            echo json_encode($validation);
        }
    }
    private static function validation($data){
       $pdo = self::connection();

       $error = false;
       if (empty($data['full_name'])){
           $error = "Full Name is required";
       }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $error = 'Invalid format email';
       }elseif (strlen($data['password']) < 6 ){
            $error = 'password must be more than 6 characters';
       }elseif ($data['password'] !== $data['password_confirm']){
            $error = 'Password mismatch';
       }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE `email`=:email");
        $stmt->execute(['email' => $data['email']]);
        $userCount = $stmt->rowCount();
        if ($userCount){
            $error = "user already exists with this email: $data[email]";
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