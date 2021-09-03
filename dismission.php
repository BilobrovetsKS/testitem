<?php

require_once 'config/connect.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Уволенные</title>
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
<a href="index.php" class="c">Весь список</a><spacer width="50" type="block">
<a href="trailperiod.php" class="c">Испытательный срок</a><spacer width="50" type="block">
        <a href="leaders.php" class="c">Начальники</a><spacer width="50" type="block">
        <p></p>
            <table>

                <tr>
                    <th>ФИО сотрудника</th>
                    <th>Причина увольнения</th>

                </tr>
                <?php
                $users = mysqli_query($connect, "SELECT `user_dismission`.`user_id`, CONCAT(`user`.`last_name`, ' ', `user`.`first_name`, ' ', `user`.`middle_name`), 
     `dismission_reason`.`description` FROM `user` JOIN `user_dismission` ON `user`.`id` = `user_dismission`.`user_id` JOIN `dismission_reason` ON `user_dismission`.`reason_id` = `dismission_reason`.`id`");
                $users = mysqli_fetch_all($users);

                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?=$user[1]?></td>
                        <td><?=$user[2]?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
</body>


</html>