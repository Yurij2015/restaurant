<?php
session_start();
require_once '../Session.php';
?>
<?php $title = "Управление списком сотрудников" ?>
<?php
require_once( '../Dbsettings.php' );
include_once( '../DB.php' );
$db = new DB( $host, $user, $password, $db_name );
?>
<?php include 'header.php' ?>
<?= isset( $_GET['msg'] ) ? $_GET['msg'] : ''; ?>
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
                    <div style="margin: 4px 0 7px 0;">
                        <a href="employee.php" class="btn btn-info">Назад</a>

                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Имя</th>
                            <th scope="col" class="text-center">Фамилия</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Должность</th>
                            <th scope="col" class="text-center">Управление записью</th>

                        </tr>
                        </thead>
                        <tbody>
						<?php
						try {
						$db       = new DB( $host, $user, $password, $db_name );
						$employee = $db->query( "SELECT * FROM employee, position WHERE employee.position_idposition = position.idposition" );
						foreach ( $employee as $employeeitem ) {
							?>
                            <tr>
                                <td><?php echo $employeeitem["name"]; ?></td>
                                <td><?php echo $employeeitem["secondname"]; ?></td>
                                <td><?php echo $employeeitem["email"]; ?></td>
                                <td><?php echo $employeeitem["positionname"]; ?></td>
								<?php
								echo '<td class="text-center"><a href="employee-edit.php';
								echo '?idemployee=';
								echo $employeeitem["idemployee"];
								echo '">';
								echo 'Изменить';
								echo '</a><br>';

								echo '<a href="employee-remove.php';
								echo '?idemployee=';
								echo $employeeitem["idemployee"];
								echo '"> Удалить</a></td>';
								?>
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