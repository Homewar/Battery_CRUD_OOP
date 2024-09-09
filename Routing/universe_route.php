<?php
$table = isset($_GET['table']) ? $_GET['table'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';
$id = isset($_GET['id']) ? $_GET['id'] : '';

switch($table){
    case 'Batteries':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    case 'BatteryModels':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    case 'BatteryTypes':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    case 'Manufacturers':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    case 'Specifications':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    case 'users':
        if ($action == 'read'){
            $table_name = $table;
            include '../Controllers/controller_read.php';
        }
        if ($action == 'create'){
            $table_name = $table;
            include '../Controllers/controller_create.php';
        }
        if($action == 'update'){
            $table_name = $table;   
            $id_table = $id;
            include '../Controllers/controller_edit.php';
        }
        if($action=='delete'){
            $table_name = $table;   
            $id_table = $id;
            include '..//Controllers/controller_delete.php';
        }
        break;

    default:
        echo "Неправильное название таблицы.";
        exit;
        
    }
?>