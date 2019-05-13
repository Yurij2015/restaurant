<?php session_start();
/**
 * Created by PhpStorm.
 * Project: taskshedule.loc.
 * File: position-remove.php.
 * Date: 05.05.2018
 * Time: 22:53
 */
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
?>
<?php
$db = new DB($host, $user, $password, $db_name);
$idposition = $_GET['idposition'];

$empl = $db->query("SELECT * FROM employee WHERE position_idposition = '{$idposition}' ");

foreach ($empl as $emplitem) {
    $posempl = $emplitem['position_idposition'];
}

if ($posempl) {
    header('location: position.php?msg=Запись не может быть удалена! Должность закреплена за сотрудником!');
} else {
    $delete = $db->query("DELETE FROM position WHERE idposition='{$idposition}' LIMIT 1");
    header('location: position.php?msg=Запись успешно удалена. ');

}

