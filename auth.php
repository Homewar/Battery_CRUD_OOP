<?php
require_once 'Database.php';
require_once 'User.php';
require_once 'Auth.php';

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

    public function login($email, $password) {
        $this->user->email = $email;
        $this->user->password = $password;

        if ($this->user->login()) {
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            echo "Авторизация успешна!";
        } else {
            echo "Неверные данные для авторизации.";
        }
    }
}

$database = new Database();
$db = $database->getConnection();

$auth = new Auth($db);

// Регистрация
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_type'] == 'register_form') {
    $auth->register($_POST['email'], $_POST['password']);
}

// Авторизация
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form_type'] == 'login_form') {
    $auth->login($_POST['email'], $_POST['password']);
}

?>