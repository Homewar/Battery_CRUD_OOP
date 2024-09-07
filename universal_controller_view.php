<?php
include_once 'database.php';
include_once 'universal_class.php';

$table_name;  // Убедитесь, что используете правильное имя таблицы

$database = new Database();
$db = $database->getConnection();

$universal = new Universe_class($db, $table_name);  // Передаем правильное имя таблицы
$columns = $universal->get_column_name();  // Получаем столбцы таблицы
$stmt = $universal->getAll();  // Получаем объект PDOStatement
$data_result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Используем fetchAll для получения всех данных

include 'universal_table.php';
?>
