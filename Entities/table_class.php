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
        // Получаем имя первого столбца (обычно это первичный ключ)
        $sql = "SHOW COLUMNS FROM " . $this->table;
        $stmt = $this->pdo->query($sql);
        $first_column = $stmt->fetch(PDO::FETCH_ASSOC)['Field'];
    
        // Выполняем запрос, используя первый столбец как условие для выборки
        $sql = "SELECT * FROM " . $this->table . " WHERE " . $first_column . " = :id";
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
        $primaryKey = $this->getPrimaryKey(); // получаем первичный ключ
        if (!$primaryKey) {
            throw new Exception("Primary key not found for table " . $this->table);
        }
    
        $columns = implode(", ", array_map(function($key) {
            return $key . " = :" . $key;
        }, array_keys($data)));
    
        $sql = "UPDATE " . $this->table . " SET $columns WHERE $primaryKey = :id";
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        
        return $stmt->execute($data);
    }

    // Удалить запись по ID
    public function delete($id) {
        $primaryKey = $this->getPrimaryKey();
        $sql = "DELETE FROM " . $this->table . " WHERE $primaryKey = :id";
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

    public function get_column_info() {
        $sql_columns = "SHOW COLUMNS FROM " . $this->table;
        $columns_result = $this->pdo->query($sql_columns);
        $columns = [];

        while ($col = $columns_result->fetch(PDO::FETCH_ASSOC)) {
            $columns[] = [
                'Field' => $col['Field'], // название поля
                'Type' => $col['Type']    // тип данных
            ];
        }

        return $columns;
    }

    public function getPrimaryKey() {
        // Предположим, что первичный ключ всегда первый столбец и содержит '_id'
        $sql = "SHOW COLUMNS FROM " . $this->table;
        $stmt = $this->pdo->query($sql);
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($columns as $column) {
            if (strpos($column['Field'], '_id') !== false) {
                return $column['Field']; // возвращаем имя первичного ключа
            }
        }
        return null; // если не найдено, вернется null
    }
}

?>