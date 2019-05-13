<?php
session_start()
/**
 * Created by PhpStorm.
 * Project: taskshedule.loc.
 * File: position-add.php.
 * Date: 19.04.2018
 * Time: 13:43
 */
?>
<?php $title = "Добавление должности" ?>
<?php
require_once('../forms/PositionForm.php');
//require_once ('forms/LoginForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$form = new PositionForm($_POST);
if ($_POST) {
    if ($form->validate()) {
        $positionname = $db->escape($form->getPosition());

        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];
        //if ( $a != 1 ) {
        if ($a == 1 || $a == 2) {
            //$msg = 'У Вас нет прав на добавление отделов!';
            $db->query("INSERT INTO position (`positionname`) VALUES ('{$positionname}') ");
            header('location: position.php?msg=Должность успешно добавлена!');
        } else {
            $msg = 'У Вас нет прав на добавление должности!';
//			$db->query( "INSERT INTO unit (`unitname`) VALUES ('{$unitname}') " );
//			header( 'location: unit.php?msg=Отдел успешно добавлен!' );
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php
include 'header.php';
include 'var.php';
?>

<hr>
<h5 align="center"><?php echo $system_name ?></h5>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
        </div>
        <div class="col-sm">
            <h5 class="text-center border border-top-0 border-right-0"
                style="line-height: 40px;"><?php echo $title ?></h5>
        </div>
    </div>
    <div class="row">
        <?php include_once('../navigation.php'); ?>
        <div class="col-sm">
            <div class="text-justify border border-bottom-0 border-right-0"
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">

                <b style="color: red;"><?= $msg; ?></b>
                <form method="post">
                    <div class="form-group">
                        <label for="unitname">Название отдела</label>
                        <input type="text" class="form-control" id="unitname" placeholder="Название должности"
                               name="positionname"
                               value="<?= $form->getPosition(); ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Сохранить</button>
                    <a href="unit.php" class="btn btn-info">Отмена</a>

                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
