<?php

require_once 'config/connect.php';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Начальники</title>
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
    <a href="trailperiod.php" class="c">Испытательный срок</a><spacer width="50" type="block">
        <a href="dismission.php" class="c">Уволенные</a><spacer width="50" type="block">
                <p></p>
    <tr>
        <th>Начальник</th>
        <th>Отдел</th>
        <th>Последний нанятый сотрудник</th>
    </tr>
    <?php
    $users = mysqli_query($connect, "SELECT m.*, CONCAT(`user`.`last_name`, ' ', `user`.`first_name`, ' ', `user`.`middle_name`)
FROM(SELECT  `user_position`.`department_id`, CONCAT(`user`.`last_name`, ' ', `user`.`first_name`, ' ', `user`.`middle_name`),
`department`.`description`, MAX(`user_id`) AS `userid` FROM `user_position` JOIN `department` ON `user_position`.`department_id` = `department`.`id`
JOIN  `user` ON  `user`. `id` = `department`.`leader_id` GROUP BY  `user_position`.`department_id`) m 
JOIN `user` ON m.userid = `user`.`id`");

    $users = mysqli_fetch_all($users);

    foreach ($users as $user) {
        ?>
        <tr>
            <td><?=$user[1]?></td>
            <td><?=$user[2]?></td>
            <td><?=$user[4]?></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>


</html>