<?php
require_once 'config/connect.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Испытательный срок</title>
</head>
<style>
    th, td{
        padding: 10px;
    }
    th{
        background: #606060;
        color: #ffffff;
    }
    td{
        background: #b5b5b5;
    }
    .c {
        border: 1px solid #333; /* Рамка */
        display: inline-block;
        padding: 5px 15px; /* Поля */
        text-decoration: none; /* Убираем подчёркивание */
        color: #000; /* Цвет текста */
    }
    .c:hover {
        box-shadow: 0 0 5px rgba(0,0,0,0.3); /* Тень */
        background: linear-gradient(to bottom, #fcfff4, #e9e9ce); /* Градиент */
        color: #a00;
    }
</style>
<body>
            <table>
                <a href="index.php" class="c">Весь список</a><spacer width="50" type="block">
                    <a href="dismission.php" class="c">Уволенные</a><spacer width="50" type="block">
                        <a href="leaders.php" class="c">Начальники</a><spacer width="50" type="block">
                <p></p>
                <tr>
                    <th>ФИО сотрудника</th>
                    <th>Дата приема на работу</th>
                </tr>
                <?php

                $users = mysqli_query($connect, "SELECT CONCAT(`user`.`last_name`, ' ', `user`.`first_name`, ' ', `user`.`middle_name`), `user`.`created_at`
                FROM `user` WHERE DATEDIFF(NOW(),`created_at`) < 90 ORDER BY `last_name` ASC");
                $users = mysqli_fetch_all($users);
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?=$user[0]?></td>
                        <td><?=$user[1]?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <p></p>


</body>

</html>