<?php session_start() ?>
<?php $title = "Обновление данных сотрудника" ?>
<?php
require_once('../forms/EmployeeForm.php');
//require_once ('forms/LoginForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$idemployee = $_GET['idemployee'];
$db = new DB($host, $user, $password, $db_name);
$form = new EmployeeForm($_POST);
if ($_POST) {
    if ($form->validate()) {
        $name = $db->escape($form->getName());
        $secondname = $db->escape($form->getSecondname());
        $emailempl = $db->escape($form->getEmail());
        $position_idposition = $db->escape($form->getPosition());

        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];

        //$idemployee = $_GET['idemployee'];

        if ($a != 1) {
            $msg = 'У Вас нет прав на обновление данных!';
            //print_r ($res); проверка
            //echo $a; проверка
        } else {
            $db->query("UPDATE `employee` SET `name` = '{$name}', secondname = '{$secondname}', email = '{$emailempl}', `position_idposition` = 
'{$position_idposition}' WHERE idemployee={$idemployee} LIMIT 1");
            header('location: employee-edit-remove.php?msg=Данные успешно обновлены!');
        }

    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
<hr>
<h5 align="center">Корпоративная информационная система</h5>
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

                <?php
                //$idemployee = $_GET['idemployee'];
                $db = new DB($host, $user, $password, $db_name);
                $employee = $db->query("SELECT * FROM employee, position WHERE employee.position_idposition = position.idposition");
                foreach ($employee as $employeeitem) {
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" placeholder="Имя"
                                   name="name"
                                   value="<?php echo $employeeitem["name"]; ?>">
                            <input type="hidden" value="<?php echo $employeeitem["idemployee"]; ?>" name="idemployee">
                        </div>

                        <div class="form-group">
                            <label for="secondname">Фамилия</label>
                            <input type="text" class="form-control" id="secondname"
                                   placeholder="Фамилия" name="secondname"
                                   value="<?php echo $employeeitem["secondname"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="position_idposition">Текущая должность</label>
                            <input type="text" class="form-control" id="position_idposition" disabled
                                   value="<?php echo $employeeitem["positionname"]; ?>">
                        </div>

                        <div class="form-group">
                            <label for="position_idposition">Обновить должность </label>
                            <select class="form-control" name="position_idposition" id="position_idposition">
                                <option value="<?php echo $employeeitem["idposition"]; ?>"
                                        selected><?php echo $employeeitem["postionname"]; ?></option>
                                <?php
                                //$db   = new DB( $host, $user, $password, $db_name );
                                $position = $db->query("SELECT idposition, positionname FROM position");
                                foreach ($position as $positionitem) {
                                    ?>
                                    <option value="<?php echo $positionitem['idposition'] ?>"><?php echo $positionitem['positionname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emailempl">Email</label>
                            <input type="text" class="form-control" id="emailempl" placeholder="Email"
                                   name="emailempl" value="<?php echo $employeeitem['email']; ?>">
                        </div>

                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="employee-edit-remove.php" class="btn btn-info">Отмена</a>

                    </form>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
