<?php
class Battery{
    private $conn;
    private $table_name = "product";

    public $id;
    public $name;
    public $voltage;
    public $amprege;
    public $watt;
    public $produced;
    public $all_capacity;
    public $BMS;

    public $columns;
    public $rows;

    //функция конструктора
    public function __construct($db){
        $this->conn = $db;
    }

    //функция получения данных из таблицы используя PDO
    function read(){
        $query = "SELECT id, name, voltage, amperage, watt, produced, all_capacity, BMS FROM ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get_column_name() {
        $sql_columns = "SHOW COLUMNS FROM " . $this->table_name;
        $columns_result = $this->conn->query($sql_columns);
        $columns = [];
        while ($col = $columns_result->fetch(PDO::FETCH_ASSOC)) {
            $columns[] = $col['Field'];
        }
        return $columns;
    }
}
?>