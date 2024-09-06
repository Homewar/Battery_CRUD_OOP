<?php
require_once 'Database.php';
require_once 'User.php';
require_once 'Auth.php';
require_once 'Battery.php'

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