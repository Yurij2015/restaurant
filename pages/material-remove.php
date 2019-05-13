<?php session_start();
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
?>
<?php
$db = new DB($host, $user, $password, $db_name);
$idtask = $_GET['idtask'];

$task = $db->query("SELECT * FROM taskforemployee WHERE task_idtask = '{$idtask}' ");

foreach ($task as $taskitem) {
    $taskforempl = $taskitem['task_idtask'];
}

if ($taskforempl) {
    header('location: material.php?msg=Запись не может быть удалена! Задача закреплена за сотрудником!');
} else {
    $delete = $db->query("DELETE FROM task WHERE idtask='{$idtask}' LIMIT 1");
    header('location: material.php?msg=Запись успешно удалена. ');

}

