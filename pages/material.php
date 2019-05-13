<?php
session_start();
require_once '../Session.php';
?>
<?php $title = "Список задач" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
    <h6 style="color: red; line-height: 20px;"
        class="text-center"><?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?></h6>
    <hr>
    <h5 align="center">Задачи для сотрудников</h5>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5 class="text-center border border-top-0 border-left-0" style="line-height: 40px;">Меню</h5>
            </div>
            <div class="col-sm">
                <h5 class="text-center border border-top-0 border-right-0"
                    style="line-height: 40px;"><?= $title ?></h5>
            </div>
        </div>
        <div class="row">
            <?php include_once('../navigation.php'); ?>
            <div class="col-sm">
                <div class="text-justify border border-bottom-0 border-right-0"
                     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
                    <div style="margin: 4px 0 7px 0;">
                        <a href="material-add.php" class="btn btn-info">Добавить материал</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Материал</th>
                            <th scope="col" class="text-center">Количество</th>
                            <th scope="col" class="text-center">Описание</th>
                            <th scope="col" class="text-center">Склад</th>
                            <th scope="col" class="text-center">Дата добавления</th>
                            <th scope="col" class="text-center">Отвественный</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $material = $db->query("SELECT * FROM material, storehouse, employee WHERE material.storehouse_idstorehouse = storehouse.idstorehouse AND material.responsible_person = employee.idemployee");
                        foreach ($material as $materialitem) {
                            ?>
                            <tr>
                                <td><?php echo $materialitem["materialname"]; ?></td>
                                <td><?php echo $materialitem["notice"]; ?></td>
                                <td><?php echo $materialitem["count"]; ?></td>
                                <td><?php echo $materialitem["price"]; ?></td>
                                <td><?php echo $materialitem["adoptiondate"]; ?></td>

                                <td><a href="material-remove.php?idtask=<?= $materialitem[''] ?>" Удалить</a>
                                </td>
                            </tr>
                        <?php }

                        ?>
                        </tbody>
                    </table>
                    <?php
                    } catch
                    (Exception $e) {
                        echo $e->getMessage() . ':(';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
<?php include 'footer.php' ?>