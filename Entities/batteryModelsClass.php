<?php
Class batteryModels{
    private $conn;
    private $table_name = "BatteryModels";

    private $model_id;
    private $battery_id;
    private $model_name;
    private $production_start;
    private $production_end;

    public $colums;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT model_id, battery_id, model_name, production_start, production_end FROM ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function get_column_name(){
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