<?php
/**
 * Project: restaurant
 * Filename: logout.php
 * Date: 16.05.2019
 * Time: 12:15
 */
session_start();
require_once('../Session.php');

Session::destroy();

header('Location: index.php?msg=Вы вышли!');