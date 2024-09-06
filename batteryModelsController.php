<?php
// Include database and Battery class
include_once 'database.php';
include_once 'batteryModelsClass.php';

// Instantiate database and Battery object
$database = new batteryModels();
$db = $database->getConnection();

$battery = new Battery($db);

$columns = $battery->get_column_name();
$stmt = $battery->read();
$data_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'universal_table.php'
?>