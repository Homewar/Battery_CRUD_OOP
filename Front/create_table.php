<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 50px;"> <!-- Добавлен отступ сверху -->
        <h2 style="background-color: #469597; padding: 20px; border-radius: 10px; text-align: left; "> <!-- Обрамление заголовка -->
        <p style="color: white;">Create New In Table: <?php echo htmlspecialchars($table_name); ?></p>
        </h2>

        <!-- Если есть ошибка, выводим сообщение об ошибке -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Форма для создания записи -->
        <form action="../Controllers/controller_create.php?table=<?php echo urlencode($table_name); ?>" method="POST">
            <?php foreach ($columns as $column): ?>
                <?php if ($column['Field'] !== $column_id): // исключаем поле id, если оно автогенерируемое ?>
                    <div class="form-group" style="font-size: large;">
                        <label style="padding: 0 px; text-align: left;" for="<?php echo htmlspecialchars($column['Field']); ?>"><p style="color: #37745B;margin-top:5px;"><?php echo htmlspecialchars($column['Field']); ?></p></label>
                        
                        <?php
                        // Генерируем разные типы input в зависимости от типа данных столбца
                        $input_type = 'text'; // По умолчанию текстовое поле

                        // Если тип данных колонки включает дату, используем input type="date"
                        if (strpos($column['Type'], 'date') !== false) {
                            $input_type = 'date';
                        }
                        // Если тип данных числовой, используем input type="number"
                        elseif (strpos($column['Type'], 'int') !== false || strpos($column['Type'], 'float') !== false || strpos($column['Type'], 'double') !== false) {
                            $input_type = 'number';
                        }
                        ?>

                        <input type="<?php echo $input_type; ?>" class="form-control" name="<?php echo htmlspecialchars($column['Field']); ?>" id="<?php echo htmlspecialchars($column['Field']); ?>" required>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</body>
</html>
