<?php
session_start();
require_once '../Session.php';
?>
<?php
$unitname = $_GET['unitname'];
$title = "Сотрудники отдела";?>
<?php
require_once( '../Dbsettings.php' );
include_once( '../DB.php' );
$db = new DB( $host, $user, $password, $db_name );
$idunit = $_GET['idunit'];
?>
<?php include 'header.php' ?>
<?= isset( $_GET['msg'] ) ? $_GET['msg'] : ''; ?>
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
				    style="line-height: 40px;"><?php echo $title ?>. <?php echo $unitname ?></h5>
			</div>
		</div>
		<div class="row">
			<?php include_once( '../navigation.php' ); ?>
			<div class="col-sm">
				<div class="text-justify border border-bottom-0 border-right-0"
				     style="line-height: 40px; padding-left: 10px; padding-right: 10px;">
					<div style="margin: 4px 0 7px 0;">
						<a href="unit.php" class="btn btn-info">Назад</a>
					</div>
					<table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col" class="text-center">Имя</th>
							<th scope="col" class="text-center">Фамилия</th>
							<th scope="col" class="text-center">Отдел</th>
							<th scope="col" class="text-center">Должность</th>
						</tr>
						</thead>
						<tbody>
						<?php
						try {
						$db       = new DB( $host, $user, $password, $db_name );
						$employee = $db->query( "SELECT * FROM `employee`, unit WHERE employee.idunit = unit.idunit AND unit.idunit={$idunit}" );
						foreach ( $employee as $employeeitem ) {
							?>
							<tr>
								<td><?php echo $employeeitem["name"]; ?></td>
								<td><?php echo $employeeitem["secondname"]; ?></td>
								<td><?php echo $employeeitem["unitname"]; ?></td>
								<td><?php echo $employeeitem["position"]; ?></td>
							</tr>
						<?php }
						?>
						</tbody>
					</table>
					<?php
					} catch
					( Exception $e ) {
						echo $e->getMessage() . ':(';
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php' ?>