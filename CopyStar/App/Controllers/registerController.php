<?php

require_once '../Services/Checker.php';
require_once '../Services/Database.php';

function register(string $login,string $password,string $password_confirm,string $email,string $name,string $lastname,string $patronymic,string $checkbox) : void
{

    $error_fields = [];
    if (strlen($login) < 4 || strlen($login) > 30 || preg_match('/[А-Яа-я@#$%^&*(.)\/\s]/', $login)) {
        $error_fields[] = 'login';
    }


    if (strlen($email) < 2 || strlen($email) > 42 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_fields[] = 'email';
    }

    if (strlen($password) < 6 || strlen($password) > 42) {
        $error_fields[] = 'password';
    }

    if (strlen($name) < 2 || strlen($name) > 30 || preg_match('/[a-zA-z0-9@#$%^&*(.)\/]/', $name)) {
        $error_fields[] = 'name';
    }

    if (strlen($lastname) < 2 || strlen($lastname) > 30 || preg_match('/[a-zA-z0-9@#$%^&*(.)\/]/', $lastname)) {
        $error_fields[] = 'lastname';
    }

    if (strlen($patronymic) > 30 || preg_match('/[a-zA-z0-9@#$%^&*(.)\/]/', $patronymic)) {
        $error_fields[] = 'patronymic';
    }


    if (!empty($error_fields)) {

        $response = [
            'status' => false,
            'msg' => 'Проверьте правильность полей',
            'type' => 1,
            'fields' => $error_fields
        ];
        echo json_encode($response);
        die();
    }


    if (!filter_var($checkbox, FILTER_VALIDATE_BOOLEAN)) {
        $response = [
            'status' => false,
            'msg' => 'Необходимо согласиться с правилами',
            'type' => 2,
            'field' => 'rules'
        ];

        echo json_encode($response);

        die();
    }

    if ($password === $password_confirm) {

        $db = new Database();

        $param = [
            'login' => $login,
        ];

        $login_check = $db->query("SELECT * FROM `users` WHERE `users`.`login` = :login", $param);

        if (!empty($login_check)) {

            $response = [
                'status' => false,
                'msg' => 'Логин занят',
                'type' => 2,
                'field' => 'login'
            ];

            echo json_encode($response);

            die();
        }


        $param = [
            'email' => $email,
        ];

        $email_check = $db->query("SELECT * FROM `users` WHERE `users`.`email` = :email", $param);

        if (!empty($email_check)) {

            $response = [
                'status' => false,
                'msg' => 'Такая почта уже существует',
                'type' => 2,
                'field' => 'email'
            ];

            echo json_encode($response);

            die();
        }

        $password = md5($password);
        $id_role = '1';
        $param =
            [
                'login' => $login,
                'password' => $password,
                'email' => $email,
                'name' => $name,
                'lastname' => $lastname,
                'patronymic' => $patronymic,
                'id_role' => $id_role
            ];


        $db->execute("INSERT INTO `users` (`id`, `login`, `password`, `email`, `name`, `lastname`, `patronymic`, `id_role`) VALUES (NULL, :login, :password, :email, :name, :lastname, :patronymic, :id_role)", $param);

        $id = $db->lastId();

        session_start();

        $_SESSION['user'] =
            [
                'id' => $id,
                'login' => $login,
                'email' => $email,
                'name' => $name,
                'lastname' => $lastname,
                'id_role' => $id_role
            ];


        $response = [
            'status' => true,
        ];
        echo json_encode($response);
        die();

    } else {

        $response = [
            'status' => false,
            'msg' => 'Пароли не совпадают',
            'type' => 2,
            'field' => 'password_confirm'
        ];

        echo json_encode($response);

        die();
    }


}


register(
    Checker::securityAgainstXxs($_POST['login']),
    Checker::securityAgainstXxs($_POST['password']),
    Checker::securityAgainstXxs($_POST['password_confirm']),
    Checker::securityAgainstXxs($_POST['email']),
    Checker::securityAgainstXxs($_POST['name']),
    Checker::securityAgainstXxs($_POST['lastname']),
    Checker::securityAgainstXxs($_POST['patronymic']),
    $_POST['checkbox']
);