<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Регистрация пользователя
    public function register() {
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        // Хешируем пароль
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Связываем параметры
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Авторизация пользователя
    public function login() {
        $query = "SELECT id, password FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверяем пароль
        if ($user && password_verify($this->password, $user['password'])) {
            $this->id = $user['id'];
            return true;
        }

        return false;
    }
}
?>