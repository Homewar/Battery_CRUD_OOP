<?php
// Include database and Battery class
include_once '../database.php';
include_once '../Entities/batteryModelsClass.php';

// Instantiate database and Battery object
$database = new Database();
$db = $database->getConnection();

$battery = new batteryModels($db);

$columns = $battery->get_column_name();
$stmt = $battery->read();
$data_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'Front/universal_table.php'
?>