<?php
/**
 * Project: restaurant
 * Filename: register.php
 * Date: 16.05.2019
 * Time: 8:17
 */
session_start();
$title = "Цены в меню";
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
                    <h2>Цены в нашем меню</h2>
                    <div class="border"></div>
                </div>
                <!-- Menu content container -->
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Блюдо</th>
                        <th scope="col" class="text-center">Стоимость летом</th>
                        <th scope="col" class="text-center">Стоимость осеннью</th>
                        <th scope="col" class="text-center">Стоимость зимой</th>
                        <th scope="col" class="text-center">Стоимость весной</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    try {
                    $db = new DB($host, $user, $password, $db_name);
                    $price = $db->query("SELECT * FROM menu, price WHERE price.menu_id_item = menu.id_item");
                    foreach ($price as $priceitem) {
                        ?>
                        <tr>
                            <td><?php echo $priceitem["del_title"]; ?></td>
                            <td><?php echo $priceitem["price_summer"]; ?></td>
                            <td><?php echo $priceitem["price_fall"]; ?></td>
                            <td><?php echo $priceitem["price_winter"]; ?></td>
                            <td><?php echo $priceitem["price_spring"]; ?></td>

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