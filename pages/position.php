<?php
session_start();
require_once '../Session.php';
?>
<?php $title = "Список должностей" ?>
<?php
require_once('../Dbsettings.php');
include_once('../DB.php');
$db = new DB($host, $user, $password, $db_name);
?>
<?php include 'header.php' ?>
    <h6 style="color: red; line-height: 20px;"
        class="text-center"><?= isset($_GET['msg']) ? $_GET['msg'] : ''; ?></h6>
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
                    <div style="margin: 4px 0 7px 0;">
                        <a href="position-add.php" class="btn btn-info">Добавить должность</a>
                        <!--                        <a href="position-edit-remove.php" class="btn btn-info">Редактировать / Удалить</a>-->

                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Название должности</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        try {
                        $position = $db->query("SELECT * FROM position");
                        foreach ($position as $positionitem) {
                            ?>
                            <tr>
                                <td><?php echo $positionitem["positionname"]; ?></td>
                                <td>
                                    <a href="position-remove.php?idposition=<?= $positionitem["idposition"] ?>">Удалить</a>


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