<?php session_start() ?>
<?php $title = "Регистрация в системе" ?>
<?php
require_once('forms/RegistrationForm.php');
require_once('DB.php');
require_once('Password.php');
require_once('Session.php');
require_once('Dbsettings.php');


$msg = '';

$db = new DB($host, $user, $password, $db_name);
$form = new RegistrationForm($_POST);


if ($_POST) {
    if ($form->validate()) {
        $email = $db->escape($form->getEmail());
        $username = $db->escape($form->getUsername());
        $usersecondname = $db->escape($form->getUserSecondName());
        $password = new Password($db->escape($form->getPassword()));

        $res = $db->query("SELECT * FROM `user` WHERE email = '{$email}'");
        if ($res) {
            $msg = 'Пользователь с таким эл. адресом уже существует!';
        } else {
            $db->query("INSERT INTO `user` (email, username, usersecondname, password) VALUES ('{$email}','{$username}', '{$usersecondname}','{$password}')");
            header('location: index.php?msg=Регистрация прошла успешно!');
        }

    } else {
        $msg = $form->passwordsMatch() ? 'Пожалуйста, заполните все поля' : 'Пароли не совпадают';
    }
}

?>
<?php include 'header.php' ?>
<div class="container">
    <div class="col-12">
        <h4 class="text-center" style="margin-top: 30px;">Регистрация в системе</h4>
        <b style="color: red;"><?= $msg; ?></b>
        <form method="post">
            <div class="form-group">
                <label for="InputEmail">Адрес электронной почты</label>
                <input type="email" class="form-control" id="InputEmail" placeholder="Ваш email" name="email"
                       value="<?= $form->getEmail(); ?>">
            </div>
            <div class="form-group">
                <label for="InputUsername">Имя пользователя</label>
                <input type="text" class="form-control" id="InputUsername"
                       placeholder="Ваше Имя" name="username" value="<?= $form->getUsername() ?>">
            </div>
            <div class="form-group">
                <label for="InputUserSecondName">Фамилия пользователя</label>
                <input type="text" class="form-control" id="InputUserSecondName" placeholder="Ваша Фамилия"
                       name="usersecondname" value="<?= $form->getUserSecondName() ?>">
            </div>
            <div class="form-group">
                <label for="InputPassword">Пароль</label>
                <input type="password" class="form-control" id="InputPassword" placeholder="Пароль" name="password">
            </div>
            <div class="form-group">
                <label for="InputPasswordConfirm">Проверка пароля</label>
                <input type="password" class="form-control" id="InputPasswordConfirm" placeholder="Проверка пароля"
                       name="passwordConfirm">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
            <a href="index.php" class="btn btn-primary">Отмена</a>

        </form>
    </div>

</div>

<?php include 'footer.php' ?>
