<?php session_start() ?>
<?php $title = "Добавление материала" ?>
<?php
require_once('../forms/MaterialForm.php');
require_once('../DB.php');
require_once('../Password.php');
require_once('../Session.php');
require_once('../Dbsettings.php');
$msg = '';
$db = new DB($host, $user, $password, $db_name);
$form = new MaterialForm($_POST);
if ($_POST) {
    if ($form->validate()) {
        $taskname = $db->escape($form->getTaskName());
        $taskdescription = $db->escape($form->getTaskDescription());
        $email = $_SESSION['email'];
        $res = $db->query("SELECT role_idrole FROM `user` WHERE email = '{$email}'");
        $a = $res[0]['role_idrole'];
        //if ( $a != 1 ) {
        if ($a == 1 || $a == 2) {
            //$msg = 'У Вас нет прав на добавление материалов!';
            $db->query("INSERT INTO material (materialname, materialdescription) VALUES ('{$materialname}', '{$materialdescription}') ");
            header('location: material.php?msg=Материал успешно добавлен!');
        } else {
            $msg = 'У Вас нет прав на добавление материала!';
//			$db->query( "INSERT INTO unit (`unitname`) VALUES ('{$unitname}') " );
//			header( 'location: unit.php?msg=Отдел успешно добавлен!' );
        }
    } else {
        $msg = 'Пожалуйста, заполните все поля';
    }
}
?>
<?php include 'header.php' ?>
<hr>
<h5 align="center">Добавление материала</h5>
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
                        <label for="productname">Название материала</label>
                        <input type="text" class="form-control" id="taskname" placeholder="Название материала"
                               name="taskname"
                               value="<?= $form->getMaterialName(); ?>">
                    </div>
                    <div class="form-group">
                        <label for="productamount">Описание материала</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Описание материала" name="taskdescription"
                               value="<?= $form->getNotice() ?>">
                    </div>
                    <div class="form-group">
                        <label for="productamount">Стоимость материала</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Стоимость материала" name="taskdescription"
                               value="<?= $form->getPrice() ?>">
                    </div>

                    <div class="form-group">
                        <label for="productamount">Количество</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Количество" name="taskdescription"
                               value="<?= $form->getCount() ?>">
                    </div>

                    <div class="form-group">
                        <label for="productamount">Место хранения</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Место хранения" name="taskdescription"
                               value="<?= $form->getNotice() ?>">
                    </div>

                    <div class="form-group">
                        <label for="productamount">Дата добавления</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Дата добавления" name="taskdescription"
                               value="<?= $form->getNotice() ?>">
                    </div>

                    <div class="form-group">
                        <label for="productamount">Отвественный сотрудник</label>
                        <input type="text" class="form-control" id="taskdescription"
                               placeholder="Отвественный сотрудник" name="taskdescription"
                               value="<?= $form->getNotice() ?>">
                    </div>

                    <button type="submit" class="btn btn-info">Сохранить</button>
                    <a href="material.php" class="btn btn-info">Отмена</a>

                </form>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
