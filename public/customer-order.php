<?php
/**
 * Project: restaurant
 * Filename: register.php
 * Date: 16.05.2019
 * Time: 8:17
 */
session_start();
$title = "Онлайн заказ";
require_once('../Session.php');
require_once('../Dbsettings.php');
require_once('../DB.php');

$msg = '';
$msg = "";
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}
$db = new DB($host, $user, $password, $db_name);

if (isset($_POST)) {
    $menu_id_item = $_POST['menu_id_item'] ?? '';
    $count = $_POST['count'] ?? '';
    $order_date = $_POST['order_date'] ?? '';
    $user = $_POST['user'] ?? '';

    $users_id_users = $db->query("SELECT id_users FROM `users` WHERE login = '{$user}'");
    foreach ($users_id_users as $users_id_usersitem) {
        $users_id_user = $users_id_usersitem['id_users'];
        //echo $users_id_user;

        $db->query("INSERT INTO `online_order` (menu_id_item, count, order_date, users_id_users) VALUES ('{$menu_id_item}','{$count}', '{$order_date}', '{$users_id_user}')");
       // header('location: menu.php?msg=Заказ успешно создан!');
        $msg = "Заказ успешно создан";
    }
}
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
                    <h2>Заказ</h2>
                    <!-- Paragraph -->
                    <p>Оформление заказа</p>
                    <b style="color: red;"><?= $msg; ?></b>

                    <!-- Border -->
                    <div class="border"></div>
                </div>
                <form method="post">
                    <div class="form-group">
                        <label for="InputMenu">Меню</label>
                        <select class="form-control" name="menu_id_item" id="InputMenu">
                            <?php
                            $menu = $db->query("SELECT * FROM menu");
                            foreach ($menu as $menuitem) {
                                ?>
                                <option value="<?php echo $menuitem['id_item'] ?>"><?php echo $menuitem['del_title'] ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="InputUsername">Количество</label>
                        <input type="text" class="form-control" id="InputUsername"
                               placeholder="Количество" name="count">
                    </div>
                    <div class="form-group">
                        <label for="InputUsername">Имя пользователя</label>
                        <input type="text" class="form-control" id="InputUsername"
                               placeholder="Ваше Имя" name="user" value="<?= Session::get('login') ?>"
                        >
                    </div>
                    <div class="form-group">
                        <label for="InputUsername">Дата</label>
                        <input type="date" class="form-control" id="InputUsername"
                               placeholder="Дата" name="order_date" value="<?= date("Y-m-d") ?>" ">
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                    <a href="menu.php" class="btn btn-primary">Отмена</a>
                </form>
            </div>
        </div>
    </div><!-- / Inner Page Content End -->
<?php include_once('footer.php'); ?>