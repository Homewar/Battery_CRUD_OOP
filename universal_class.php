<?php
class Universe_class {

    private $pdo;
    private $table;

    // Конструктор принимает имя таблицы
    public function __construct($db, $table) {
        $this->pdo = $db;
        $this->table = $table;
    }

    // Получить все записи из таблицы
    public function getAll() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Получить одну запись по ID
    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // Создать новую запись
    public function create(array $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(function($key) {
            return ":" . $key;
        }, array_keys($data)));
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // Обновить запись по ID
    public function update($id, array $data) {
        $columns = implode(", ", array_map(function($key) {
            return $key . " = :" . $key;
        }, array_keys($data)));
        $sql = "UPDATE " . $this->table . " SET $columns WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    // Удалить запись по ID
    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    function get_column_name(){
        $sql_columns = "SHOW COLUMNS FROM " . $this->table;
        $columns_result = $this->pdo->query($sql_columns);
        $columns = [];
        while ($col = $columns_result->fetch(PDO::FETCH_ASSOC)) {
            $columns[] = $col['Field'];
        }
        return $columns;
    }
}

?>