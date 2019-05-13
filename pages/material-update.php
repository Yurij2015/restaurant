<?php session_start() ?>
<?php $title = "Обноваить товар" ?>
<?php
require_once( '../forms/ProductForm.php' );
require_once( '../DB.php' );
require_once( '../Password.php' );
require_once( '../Session.php' );
require_once( '../Dbsettings.php' );
$msg       = '';
$db        = new DB( $host, $user, $password, $db_name );
$idproduct = $_GET['idproduct'];
$form      = new ProductForm( $_POST );
if ( $_POST ) {
	if ( $form->validate() ) {
		$productname   = $db->escape( $form->getProductname() );
		$productamount = $db->escape( $form->getProductamount() );
		$productcost   = $db->escape( $form->getProductcost() );
		$productinfo   = $db->escape( $form->getProductinfo() );


		$email = $_SESSION['email'];
		$res   = $db->query( "SELECT userrole FROM `user` WHERE email = '{$email}'" );
		$a     = $res[0]['userrole'];
		if ( $a != 1 ) {
			$msg = 'У Вас нет прав на обновление информации!';

		} else {
			$db->query( "UPDATE `product` SET productname = '{$productname}', productamount = '{$productamount}', productcost = '{$productcost}', productinfo = '{$productinfo}' WHERE idproduct={$idproduct} LIMIT 1" );
			header( 'location: material.php?msg=Товар успешно обновлен!' );
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
		<?php include_once( '../navigation.php' ); ?>
        <div class="col-sm">
            <div class="text-justify border border-bottom-0 border-right-0"
                 style="line-height: 40px; padding-left: 10px; padding-right: 10px;">

                <b style="color: red;"><?= $msg; ?></b>

				<?php
				$product = $db->query( "SELECT * FROM product WHERE idproduct={$idproduct}" );
				foreach ( $product as $productitem ) {
					?>
                    <form method="post">
                        <div class="form-group">
                            <label for="productname">Название товара</label>
                            <input type="text" class="form-control" id="productname" placeholder="Название товара"
                                   name="productname"
                                   value="<?= $productitem["productname"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="productamount">Количество</label>
                            <input type="text" class="form-control" id="productamount"
                                   placeholder="Количество" name="productamount"
                                   value="<?= $productitem["productamount"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="productcost">Цена</label>
                            <input type="text" class="form-control" id="productcost" placeholder="Цена"
                                   name="productcost" value="<?= $productitem["productcost"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="productinfo">Описание</label>
                            <input type="text" class="form-control" id="productinfo" placeholder="Описание"
                                   name="productinfo" value="<?= $productitem["productinfo"]; ?>">
                        </div>
                        <button type="submit" class="btn btn-info">Сохранить</button>
                        <a href="material.php" class="btn btn-info">Отмена</a>

                    </form>
					<?php
				}
				?>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
