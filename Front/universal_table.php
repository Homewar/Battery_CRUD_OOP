<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .container_2 {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            width: 45.5%;
        }
        .container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        table {
            width: 80%;
        }
        .table thead {
            background-color: #4CAF50;
            color: white; 
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="table table-striped-columns table-hover table-bordered">
            <thead>
                <tr>
                    <?php foreach ($columns as $column): ?>
                        <th scope="col"><?php echo htmlspecialchars($column); ?></th>
                    <?php endforeach; ?>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data_result)) {
                    foreach ($data_result as $row) {
                        echo "<tr>";
                        foreach ($columns as $column) {
                            echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                        }
                        // Добавление кнопок для действий (редактировать/удалить)
                        echo "<td class='action-buttons'>
                            <form action='edit.php' method='GET' style='display:inline-block;'>
                                <input type='hidden' name='table' value='" . htmlspecialchars($table_name) . "'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                <button type='submit' class='btn btn-warning'>Edit</button>
                            </form>
                            <form action='table_page.php' method='GET' style='display:inline-block;'>
                                <input type='hidden' value='delete_form' name='form_type'>
                                <input type='hidden' name='table' value='" . htmlspecialchars($table_name) . "'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</button>
                            </form>
                        </td>";
                        echo "</tr>";         
                    }
                } else {
                    echo "<tr><td colspan='" . (count($columns) + 1) . "'>No records found.</td></tr>";
                }
                ?>                   
            </tbody>
        </table>
        <br><br>
    </div>
    <div class="container_2">
        <a href="add.php?table=<?php echo urlencode($table_name); ?>" class="btn btn-success">Add New</a>
    </div>
    <!-- Подключение Bootstrap JS и зависимости -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
