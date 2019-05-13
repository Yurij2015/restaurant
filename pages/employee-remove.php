<?php session_start();
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
?>
<?php
$db = new DB($host, $user, $password, $db_name);
$idemployee = $_GET['idemployee'];

$task = $db->query("SELECT * FROM taskforemployee WHERE employee_idemployee = '{$idemployee}' ");

foreach ($task as $taskitem) {
    $taskforempl = $taskitem['employee_idemployee'];
}

//echo $taskforempl;

if ($taskforempl) {
    header('location: employee.php?msg=Запись не может быть удалена! За сотрудником закреплены задачи!');
} else {
    $delete = $db->query("DELETE FROM employee WHERE idemployee='{$idemployee}' LIMIT 1");
    header('location: employee.php?msg=Запись успешно удалена. ');

}

