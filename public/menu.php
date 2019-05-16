<?php
/**
 * Project: restaurant
 * Filename: register.php
 * Date: 16.05.2019
 * Time: 8:17
 */
session_start();
$title = "Наше меню";
require_once('../Session.php');
require_once('../Dbsettings.php');
require_once('../DB.php');
include_once('header.php');
?>
    <!-- Banner Start -->
    <div class="banner padd">
        <div class="container">
            <!-- Image -->
            <img class="img-responsive" src="img/crown-white.png" alt=""/>
            <!-- Heading -->
            <h2 class="white"><?= $title ?></h2>
            <ol class="breadcrumb">
                <li><a href="index.php">Главная</a></li>
                <li class="active"><?= $title ?></li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Inner Content -->
    <div class="inner-page padd">

        <div class="menu padd">
            <div class="container">
                <!-- Default Heading -->
                <div class="default-heading">
                    <!-- Crown image -->
                    <img class="img-responsive" src="img/crown.png" alt=""/>
                    <!-- Heading -->
                    <h2>Меню</h2>
                    <!-- Paragraph -->
                    <p>Наше меню с лучшими блюдами в городе</p>
                    <!-- Border -->
                    <div class="border"></div>
                </div>
                <!-- Menu content container -->
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Наименование</th>
                        <th scope="col" class="text-center">Класс меню</th>
                        <th scope="col" class="text-center">Количество порций</th>
                        <th scope="col" class="text-center">Ресторан</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    try {
                    $db = new DB($host, $user, $password, $db_name);
                    $menu = $db->query("SELECT * FROM menu, restorans WHERE menu.restorans_id_restoran = restorans.id_restoran");
                    foreach ($menu as $menuitem) {
                        ?>
                        <tr>
                            <td><?php echo $menuitem["del_title"]; ?></td>
                            <td><?php echo $menuitem["class_menu"]; ?></td>
                            <td><?php echo $menuitem["number_peace_menu"]; ?></td>
                            <td><?php echo $menuitem["resto_title"]; ?></td>
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
    </div><!-- / Inner Page Content End -->
<?php include_once('footer.php'); ?>