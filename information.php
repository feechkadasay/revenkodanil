<?php
include "functions_db.php";

try {
    $contacts = getAllinformation();
    
    if (empty($contacts)) {
        throw new Exception("Контактная информация не найдена");
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои контакты</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4a6fa5;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .error {
            color: red;
            text-align: center;
            padding: 20px;
        }
        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4a6fa5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #3a5a80;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Мои контактные данные</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php elseif (!empty($contacts)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Тип контакта</th>
                        <th>Данные</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['ТипКонтакта']); ?></td>
                        <td>
                            <?php if(filter_var($contact['ДанныеКонтакта'], FILTER_VALIDATE_EMAIL)): ?>
                                <a href="mailto:<?php echo htmlspecialchars($contact['ДанныеКонтакта']); ?>">
                                    <?php echo htmlspecialchars($contact['ДанныеКонтакта']); ?>
                                </a>
                            <?php elseif(strpos($contact['ДанныеКонтакта'], 'http') === 0): ?>
                                <a href="<?php echo htmlspecialchars($contact['ДанныеКонтакта']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($contact['ДанныеКонтакта']); ?>
                                </a>
                            <?php else: ?>
                                <?php echo htmlspecialchars($contact['ДанныеКонтакта']); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <a href="index.html" class="back-btn">
            <i class="fas fa-arrow-left"></i> Вернуться на главную
        </a>
    </div>
</body>
</html>