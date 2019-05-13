<?php
/**
 * Created by PhpStorm.
 * Date: 19.12.2017
 * Time: 9:59
 */

session_start();
require_once 'Session.php';

Session::destroy();

header('Location: index.php?msg=Вы вышли!');