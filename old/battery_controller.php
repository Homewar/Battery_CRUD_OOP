<?php
// Include database and Battery class
include_once 'database.php';
include_once 'battery_class.php';

// Instantiate database and Battery object
$database = new Database();
$db = $database->getConnection();

$battery = new Battery($db);

$columns = $battery->get_column_name();
$stmt = $battery->read();
$data_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'universal_table.php'
?>
