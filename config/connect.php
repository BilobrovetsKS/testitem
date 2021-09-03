<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'testitem');

if(!$connect) {
    die('Error connect to base');
}