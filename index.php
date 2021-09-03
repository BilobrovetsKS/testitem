<?php

require_once 'config/connect.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>База данных</title>
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
<a href="trailperiod.php" class="c">Испытательный срок</a><spacer width="50" type="block">
    <a href="dismission.php" class="c">Уволенные</a><spacer width="50" type="block">
        <a href="leaders.php" class="c">Начальники</a><spacer width="50" type="block">
            <table>
                <p></p>
                <tr>
                    <th>id</th>
                    <th>ФИО сотрудника</th>
                    <th>Дата рождения</th>
                    <th>Дата приема на работу</th>
                    <th>Должность</th>
                    <th>Зарплата</th>
                </tr>
                <?php
                $page = 1; // текущая страница
                $count = 25;  //количество записей для вывода
                if (isset($_GET['page']) && $_GET['page'] > 0)
                {
                    $page = $_GET['page'];
                }
                $start = ($page - 1) * $count;  // определяем, с какой записи нам выводить

                $users = mysqli_query($connect, "SELECT `user`.`id`, CONCAT(`user`.`last_name`, ' ', `user`.`first_name`, ' ', `user`.`middle_name`),
      `user`.`data_of_birth`, `user`.`created_at`, `position`.`name`, `position`.`salary` FROM `user` JOIN `user_position`
    ON `user`.`id` = `user_position`.`user_id` JOIN `position` ON `user_position`.`position_id` = `position`.`id` ORDER BY `user`.`id` ASC LIMIT $start, $count");
                $users = mysqli_fetch_all($users);
                $rsl = mysqli_query($connect, "SELECT COUNT(*) FROM `user`");
                $row = mysqli_fetch_row($rsl);
                $total = $row[0]; // всего записей

                $str_pag = ceil($total / $count); // сколько всго должно быть страниц

                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?=$user[0]?></td>
                        <td><?=$user[1]?></td>
                        <td><?=$user[2]?></td>
                        <td><?=$user[3]?></td>
                        <td><?=$user[4]?></td>
                        <td><?=$user[5]?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <p></p>
            <?php
            for ($i = 1; $i <= $str_pag; $i++){
                $link = "<a href=index.php?page=".$i." class='c'> Страница ".$i."</a>"." ";
                echo $link;
            } // вывод ссылок по страницам из цикла
            ?>
</body>
</html>