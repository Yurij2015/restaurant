<?php
/**
 * Project: restaurant
 * Filename: header.php
 * Date: 16.05.2019
 * Time: 8:15
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Title here -->
    <title><?= $title; ?></title>
    <!-- Description, Keywords and Author -->
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your,Keywords">
    <meta name="author" content="ResponsiveWebInc">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link href="css/settings.css" rel="stylesheet">
    <!-- FlexSlider Css -->
    <link rel="stylesheet" href="css/flexslider.css" media="screen"/>
    <!-- Portfolio CSS -->
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Less -->
    <link href="css/less-style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!--[if IE]>
    <link rel="stylesheet" href="css/ie-style.css"><![endif]-->

    <!-- Favicon -->
    <link rel="shortcut icon" href="index.html#">
</head>

<body>

<!-- Page Wrapper -->
<div class="wrapper">

    <!-- Header Start -->

    <div class="header">
        <div class="container">
            <!-- Header top area content -->
            <div class="header-top">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <!-- Header top left content contact -->
                        <div class="header-contact">
                            <!-- Contact number -->
                            <span><i class="fa fa-phone red"></i> 897-659-5489</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <!-- Link -->
                    <a href="index.html">
                        <!-- Logo area -->
                        <div class="logo">
                            <img class="img-responsive" src="img/logo.png" alt=""/>
                            <!-- Heading -->
                            <h1>Restaurant</h1>
                            <!-- Paragraph -->
                            <p>Best restaurant for everyone</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-8 col-sm-7">
                    <!-- Navigation -->
                    <nav class="navbar navbar-default navbar-right" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="index.html"><img src="img/nav-menu/nav1.jpg" class="img-responsive"
                                                                  alt=""/> Главная</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                                src="img/nav-menu/nav5.jpg" class="img-responsive" alt=""/> Страницы <b
                                                class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="error.html">Рестораны</a></li>
                                            <li><a href="0-base.html">Меню</a></li>
                                            <li><a href="blog.html">Цены</a></li>
                                            <li><a href="blog-single.html">Регистрация</a></li>
                                            <li><a href="blog-single.html">Авторизация</a></li>
                                            <li><a href="../admin" target="_blank">Административная панель</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </div> <!-- / .container -->
    </div>

    <!-- Header End -->
