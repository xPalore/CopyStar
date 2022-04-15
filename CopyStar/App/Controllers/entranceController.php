<?php


require_once '../Services/Database.php';

function entrance(string $login, string $password): void
{
    $db = new Database();
    $param = [
        'login' => $login,
        'password' => md5($password)
    ];
    $find_user = $db->query("SELECT * FROM `users` WHERE `users`.`login` = :login AND `users`.`password` = :password", $param);

    if (!empty($find_user)) {
        session_start();

        foreach ($find_user as $user) {
            $_SESSION['user'] =
                [
                    'id' => $user['id'],
                    'login' => $user['login'],
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'lastname' => $user['lastname'],
                    'id_role' => $user['id_role']
                ];
        }


        $response = [
            'status' => true
        ];

        echo json_encode($response);
        die();

    } else {
        $response = [
            'status' => false,
            'type' => 1,
            'msg' => 'Неверный логин или пароль',
            'fields' => [
                'login',
                'password'
            ]
        ];

        echo json_encode($response);
        die();
    }

}

entrance($_POST['login'], $_POST['password']);