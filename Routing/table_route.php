<?php
$table = isset($_GET['table']) ? $_GET['table'] : '';

switch($table){
    case 'BatteryModels':
        include '../Controllers/batteryModelsController.php';
        break;
    case 'users':
        $stmt = $pdo->prepare("SELECT * FROM users");
        break;
    default:
        echo "Неправильное название таблицы.";
        exit;
}

?>