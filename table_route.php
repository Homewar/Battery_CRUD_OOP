<?php
$table = isset($_GET['table']) ? $_GET['table'] : '';

switch($table){
    case 'product':
        include 'battery_controller.php';
        break;
    case 'users':
        $stmt = $pdo->prepare("SELECT * FROM users");
        break;
    default:
        echo "Неправильное название таблицы.";
        exit;
}

?>