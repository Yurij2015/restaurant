<?php
/**
 * Project: restaurant
 * Filename: register.php
 * Date: 16.05.2019
 * Time: 8:17
 */
session_start();
$title = "Цены на услуги";
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
                    <h2>Цены на наши услуги</h2>
                    <!-- Border -->
                    <div class="border"></div>
                </div>
                <!-- Menu content container -->
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Услуга</th>
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
                    $priceservice = $db->query("SELECT * FROM service, season_price_service WHERE season_price_service.service_id_service = service.id_service");
                    foreach ($priceservice as $priceserviceitem) {
                        ?>
                        <tr>
                            <td><?php echo $priceserviceitem["service_title"]; ?></td>
                            <td><?php echo $priceserviceitem["price_summer"]; ?></td>
                            <td><?php echo $priceserviceitem["price_fall"]; ?></td>
                            <td><?php echo $priceserviceitem["price_winter"]; ?></td>
                            <td><?php echo $priceserviceitem["price_spring"]; ?></td>
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