<?php
$table = isset($_GET['table']) ? $_GET['table'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

switch($table){
    case 'batteryModels':
        if ($action == 'read'){
            $table_name = $table;
            include 'universal_controller_view.php';
        }
        break;
    case 'users':
        if ($action == 'read'){
            $table_name = $table;
            include 'universal_controller_view.php';
        }
        break;
    
    default:
        echo "Неправильное название таблицы.";
        exit;
        
    }

?>