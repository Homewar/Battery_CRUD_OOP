<?php
class Auth {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($this->db);
    }

    public function register($username, $password) {
        $this->user->login = $username;
        $this->user->salt_password = $password;

        if ($this->user->register()) {
            echo "Регистрация прошла успешно!";
        } else {
            echo "Ошибка регистрации.";
        }
    }

    public function login($username, $password) {
        $this->user->login = $username;
        $this->user->salt_password = $password;

        if ($this->user->login()) {
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            echo "Авторизация успешна!";
        } else {
            echo "Неверные данные для авторизации.";
        }
    }
}
?>