<?php session_start() ?>
<?php $title = "Добавление сотрудника" ?>
<?php
require_once('../forms/EmployeeForm.php');
//require_once ('forms/LoginForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$form = new EmployeeForm($_POST);
if ($_POST) {
    if ($form->validate()) {
        $name = $db->escape($form->getName());
        $secondname = $db->escape($form->getSecondname());
        $position_idposition = $db->escape($form->getPosition());
        $emailempl = $db->escape($form->getEmail());

        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];
        if ($a == 1 || $a == 2) {
            $db->query("INSERT INTO employee (`name`, secondname, `position_idposition`, email) VALUES ('{$name}','{$secondname}', 
'{$position_idposition}', '{$emailempl}') ");
            header('location: employee.php?msg=Сотрудник успешно добавлен!');


            //print_r ($res); проверка
            //echo $a; проверка
        } else {
            $msg = 'У Вас нет прав на добавление документа!';
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
<hr>
<h5 align="center">Менеджер задач</h5>
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
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" placeholder="Имя"
                               name="name"
                               value="<?= $form->getName(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="secondname">Фамилия</label>
                        <input type="text" class="form-control" id="secondname" placeholder="Фамилия"
                               name="secondname" value="<?= $form->getSecondname() ?>">
                    </div>

                    <div class="form-group">
                        <label for="secondname">Email</label>
                        <input type="email" required class="form-control" id="emailempl" placeholder="Email"
                               name="emailempl" value="<?= $form->getEmail() ?>">
                    </div>

                    <div class="form-group">
                        <label for="idunit">Должность</label>
                        <select class="form-control" name="position_idposition" id="position_idposition">
                            <?php
                          //  $db = new DB($host, $user, $password, $db_name);
                            $position = $db->query("SELECT idposition, positionname FROM position");
                            foreach ($position as $positionitem) {
                                ?>
                                <option value="<?php echo $positionitem['idposition'] ?>"><?php echo $positionitem['positionname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info">Сохранить</button>
                    <a href="employee.php" class="btn btn-info">Отмена</a>

                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
