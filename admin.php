<?php
session_start();
require_once 'Session.php';

if (Session::has('email')) {
    echo 'Добро пожаловать в административную панель, ' . Session::get('email');
} else {
    echo 'Защищенная часть!';
    // header('Location: index.php');
}