<?php
/**
 * Project: restaurant
 * Filename: register.php
 * Date: 16.05.2019
 * Time: 8:17
 */
session_start();
$title = "Наши рестораны";

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
        <!-- Contact Us Start -->
        <div class="contactus">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Contact form -->
                        <div class="register-form">
                            <!-- Heading -->
                            <h3><?= $title ?></h3>

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">Название реторана</th>
                                    <th scope="col" class="text-center">Описание</th>
                                    <th scope="col" class="text-center">Адрес</th>
                                    <th scope="col" class="text-center">Электронная почта</th>
                                    <th scope="col" class="text-center">Номер телефона</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                try {
                                $db = new DB($host, $user, $password, $db_name);
                                $restorans = $db->query("SELECT * FROM restorans");
                                foreach ($restorans as $restoran) {
                                    ?>
                                    <tr>
                                        <td><?php echo $restoran["resto_title"]; ?></td>
                                        <td><?php echo $restoran["description"]; ?></td>
                                        <td><?php echo $restoran["address"]; ?></td>
                                        <td><?php echo $restoran["email"]; ?></td>
                                        <td><?php echo $restoran["number_phone_restoran"]; ?></td>

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
                        </div><!--/ Restorans list end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Us End -->
    </div><!-- / Inner Page Content End -->
<?php include_once('footer.php'); ?>