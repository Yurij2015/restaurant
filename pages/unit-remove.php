<?php session_start() ?>
<?php $title = "Удаление отдела" ?>
<?php
//require_once( '../forms/ClientForm.php' );
//require_once ('forms/LoginForm.php');
require_once( '../DB.php' );
require_once( '../Password.php' );
require_once( '../Session.php' );
require_once( '../Dbsettings.php' );
$msg = '';
$db  = new DB( $host, $user, $password, $db_name );

if ( $_POST ) {

	$idunit = $_GET['idunit'];

	$db->query( "DELETE FROM unit WHERE idunit='{$idunit}' LIMIT 1" );
	header( 'location: unit-edit-remove.php?msg=Запись успешно удалена!' );
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
                <h6 class="text-center" style="padding-top: 15px; color: red;">Вы уверены, что хотите удалить эту
                    запись?</h6>

                <b style="color: red;"><?= $msg; ?></b>

				<?php
				$idunit = $_GET['idunit'];
				$db     = new DB( $host, $user, $password, $db_name );
				$unit   = $db->query( "SELECT * FROM unit WHERE idunit={$idunit}" );
				foreach ( $unit as $unititem ) {
					?>
                    <form method="post">
                        <div class="form-group">
                            <label for="clientname">Отдел</label>
                            <input type="text" class="form-control" id="clientname" placeholder="Отдел"
                                   name="clientname" disabled
                                   value="<?php echo $unititem["unitname"]; ?>">
                            <input type="hidden" value="<?php echo $unititem["idunit"]; ?>" name="idunit">
                        </div>
                        <button type="submit" class="btn btn-info">Удалить запись</button>
                        <a href="unit-edit-remove.php" class="btn btn-info">Отмена</a>

                    </form>
					<?php
				}
				?>
            </div>
        </div>
    </div>

</div>


<?php include 'footer.php' ?>
