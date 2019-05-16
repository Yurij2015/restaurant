<?php
session_start();
require_once 'Session.php';
?>
<?php
//проверка, авторизирован ли пользователь
//if (!Session::has('email')) {
//    //$msg = 'У Вас нет доступа к сайту. Войдите на сайт!';
//    //перенаправление на форму авторизации
//    header('Location: login.php?msg=У Вас нет доступа к сайту. Войдите на сайт!');
//}
?>
<?php $title = "Главная страница" ?>
<?php
require_once('Dbsettings.php');
include_once('DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'pages/header.php' ?>
<?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?>
<hr>
<h5 align="center">Ресторан</h5>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
        </div>
        <div class="col-sm">
            <h5 class="text-center border border-top-0 border-right-0" style="line-height: 40px;">Список материалов</h5>
        </div>
    </div>
    <div class="row">
        <?php include_once('navigation.php'); ?>
        <div class="col-sm">
            <div class="text-justify border border-bottom-0 border-right-0"
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                <p style="line-height: 30px; margin-bottom: 5px">Административная панель</p>
                Управление данными веб-приложения

            </div>
        </div>
    </div>
</div>
<?php include 'pages/footer.php' ?>
