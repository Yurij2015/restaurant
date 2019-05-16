<?php
session_start();
require_once('../Session.php');
$msg .= $_GET['msg'];
include_once('header.php')
?>
    <!-- Slider Start
    #################################
        - THEMEPUNCH BANNER -
    #################################	-->
    <b style="color: red;"><?= $msg; ?></b>
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>    <!-- SLIDE  -->
                <li data-transition="fade" data-slotamount="7" data-masterspeed="1500">
                    <!-- MAIN IMAGE -->
                    <img src="img/slider/slide2.jpg" alt="" data-bgfit="cover" data-bgposition="center bottom"
                         data-bgrepeat="no-repeat">

                    <!-- LAYERS -->
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption lfl largeblackbg br-red"
                         data-x="20"
                         data-y="100"
                         data-speed="1500"
                         data-start="1200"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3">Готовим лучшие блюда...
                    </div>
                    <!-- LAYER NR. 2.0 -->
                    <div class="tp-caption lfl medium_bg_darkblue br-green"
                         data-x="20"
                         data-y="200"
                         data-speed="1500"
                         data-start="1800"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off">Рыбные
                    </div>
                    <!-- LAYER NR. 2.1 -->
                    <div class="tp-caption lfl medium_bg_darkblue br-lblue"
                         data-x="20"
                         data-y="250"
                         data-speed="1500"
                         data-start="2100"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3">Мясные
                    </div>
                    <!-- LAYER NR. 2.2 -->
                    <div class="tp-caption lfl medium_bg_darkblue br-purple"
                         data-x="20"
                         data-y="300"
                         data-speed="1500"
                         data-start="2400"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3">Сладкие
                    </div>
                    <!-- LAYER NR. 2.3 -->
                    <div class="tp-caption lfl medium_bg_darkblue br-orange"
                         data-x="20"
                         data-y="350"
                         data-speed="1500"
                         data-start="2700"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3">Напитки
                    </div>
                    <!-- LAYER NR. 3.0 -->
                    <div class="tp-caption customin customout"
                         data-x="right" data-hoffset="-50"
                         data-y="100"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="400"
                         data-start="3600"
                         data-easing="Power3.easeInOut"
                         data-endspeed="300"
                         style="z-index: 5"><img class="slide-img img-responsive" src="img/slider/s21.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 3.1 -->
                    <div class="tp-caption customin customout"
                         data-x="right" data-hoffset="-120"
                         data-y="130"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="400"
                         data-start="3900"
                         data-easing="Power3.easeInOut"
                         data-endspeed="300"
                         style="z-index: 6"><img class="slide-img img-responsive" src="img/slider/s22.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 3.2 -->
                    <div class="tp-caption customin customout"
                         data-x="right" data-hoffset="-10"
                         data-y="160"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="400"
                         data-start="4200"
                         data-easing="Power3.easeInOut"
                         data-endspeed="300"
                         style="z-index: 7"><img class="slide-img img-responsive" src="img/slider/s23.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 3.3 -->
                    <div class="tp-caption customin customout"
                         data-x="right" data-hoffset="-80"
                         data-y="190"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="400"
                         data-start="4500"
                         data-easing="Power3.easeInOut"
                         data-endspeed="300"
                         style="z-index: 8"><img class="slide-img img-responsive" src="img/slider/s24.png" alt=""/>
                    </div>
                </li>
                <li data-transition="zoomin" data-slotamount="6" data-masterspeed="400">
                    <!-- MAIN IMAGE -->
                    <img src="img/slider/transparent.png" style="background-color:#fff" alt="" data-bgfit="cover"
                         data-bgposition="center bottom" data-bgrepeat="no-repeat">

                    <!-- LAYERS -->
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption sfl modern_medium_light"
                         data-x="20"
                         data-y="90"
                         data-speed="800"
                         data-start="1000"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3">Новинки от
                    </div>
                    <!-- LAYER NR. 1.1 -->
                    <div class="tp-caption large_bold_grey heading customin customout"
                         data-x="10"
                         data-y="125"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.05"
                         data-start="1500"
                         data-speed="900"
                         data-easing="Back.easeOut"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-endspeed="500"
                         data-endeasing="Power3.easeInOut"
                         data-captionhidden="on"
                         style="z-index:5">Resto
                    </div>
                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption customin customout"
                         data-x="right"
                         data-y="100"
                         data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="800"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3"><img class="img-responsive" src="img/slider/s11.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 2.1 -->
                    <div class="tp-caption customin customout"
                         data-x="right"
                         data-y="100"
                         data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="800"
                         data-start="2300"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3"><img class="img-responsive" src="img/slider/s12.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 2.2 -->
                    <div class="tp-caption customin customout"
                         data-x="right"
                         data-y="100"
                         data-customin="x:50;y:150;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.5;scaleY:0.5;skewX:0;skewY:0;opacity:0;transformPerspective:0;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="800"
                         data-start="2600"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 3"><img class="img-responsive" src="img/slider/s13.png" alt=""/>
                    </div>
                    <!-- LAYER NR. 2.3 -->
                    <div class="tp-caption sft"
                         data-x="right" data-hoffset="-400"
                         data-y="80"
                         data-speed="1000"
                         data-start="3000"
                         data-easing="Power4.easeOut"
                         data-endspeed="500"
                         data-endeasing="Power4.easeIn"
                         style="z-index: 10"><span class="price-tag br-white">30%<br/>Off</span>
                    </div>
                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption finewide_verysmall_white_mw paragraph customin customout tp-resizeme"
                         data-x="20"
                         data-y="210"
                         data-customin="x:0;y:50;z:0;rotationX:-120;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="3600"
                         data-easing="Power3.easeInOut"
                         data-splitin="lines"
                         data-splitout="lines"
                         data-elementdelay="0.2"
                         data-endelementdelay="0.08"
                         data-endspeed="300"
                         style="z-index: 10; max-width: auto; max-height: auto; white-space: nowrap;">Представляем
                        вашему вниманю наши сезонные новинки по акционной цене.
                    </div>

                </li>
                <li data-transition="slidehorizontal" data-slotamount="1" data-masterspeed="600">
                    <!-- MAIN IMAGE -->
                    <img src="img/slider/transparent.png" style="background-color:#fea501" alt="" data-bgfit="cover"
                         data-bgposition="center bottom" data-bgrepeat="no-repeat">
                    <!-- LAYERS NR. 1 -->
                    <div class="tp-caption lfl"
                         data-x="left"
                         data-y="100"
                         data-speed="800"
                         data-start="1200"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Linear.easeNone"
                         data-captionhidden="off"><img class="img-responsive" src="img/slider/s35.png" alt=""/>
                    </div>
                    <!-- LAYERS NR. 2 -->
                    <div class="tp-caption lfr large_bold_grey heading white"
                         data-x="right" data-hoffset="-10"
                         data-y="120"
                         data-speed="800"
                         data-start="2000"
                         data-easing="Power4.easeOut"
                         data-endspeed="300"
                         data-endeasing="Linear.easeNone"
                         data-captionhidden="off">Популярное
                    </div>
                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption whitedivider3px customin customout tp-resizeme"
                         data-x="right" data-hoffset="-20"
                         data-y="210" data-voffset="0"
                         data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="700"
                         data-start="2300"
                         data-easing="Power3.easeInOut"
                         data-splitin="none"
                         data-splitout="none"
                         data-elementdelay="0.1"
                         data-endelementdelay="0.1"
                         data-endspeed="500"
                         style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">&nbsp;
                    </div>
                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption finewide_medium_white randomrotate customout tp-resizeme"
                         data-x="right" data-hoffset="-10"
                         data-y="245" data-voffset="0"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="2700"
                         data-easing="Power3.easeInOut"
                         data-splitin="chars"
                         data-splitout="chars"
                         data-elementdelay="0.08"
                         data-endelementdelay="0.08"
                         data-endspeed="500"
                         style="z-index: 4; max-width: auto; max-height: auto; white-space: nowrap;">Гамбургер
                    </div>
                    <!-- LAYER NR. 5 -->
                    <div class="tp-caption finewide_verysmall_white_mw white customin customout tp-resizeme text-right paragraph"
                         data-x="right" data-hoffset="-10"
                         data-y="300"
                         data-customin="x:0;y:50;z:0;rotationX:-120;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 0%;"
                         data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                         data-speed="1000"
                         data-start="3500"
                         data-easing="Power3.easeInOut"
                         data-splitin="lines"
                         data-splitout="lines"
                         data-elementdelay="0.2"
                         data-endelementdelay="0.08"
                         data-endspeed="300"
                         style="z-index: 10; max-width: auto; max-height: auto; white-space: nowrap;">Заказывайте у нас
                        популярные,<br/> продукты, которые распространены <br/> по всему миру.
                    </div>
                </li>
            </ul>
            <!-- Banner Timer -->
            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!-- Slider End -->
    <!-- Main Content -->
    <div class="main-content">
        <!-- Dishes Start -->
        <div class="dishes padd">
            <div class="container">
                <!-- Default Heading -->
                <div class="default-heading">
                    <!-- Crown image -->
                    <img class="img-responsive" src="img/crown.png" alt=""/>
                    <!-- Heading -->
                    <h2>Любимые блюда</h2>
                    <!-- Paragraph -->
                    <p>Мы порадуем самых изысканных клиентов лучшими блюдами по рецептам со всего мира</p>
                    <!-- Border -->
                    <div class="border"></div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="dishes-item-container">
                            <!-- Image Frame -->
                            <div class="img-frame">
                                <!-- Image -->
                                <img src="img/dish/dish5.jpg" class="img-responsive" alt=""/>
                                <!-- Block for on hover effect to image -->
                                <div class="img-frame-hover">
                                    <!-- Hover Icon -->
                                    <a href="index.php#"><i class="fa fa-cutlery"></i></a>
                                </div>
                            </div>
                            <!-- Dish Details -->
                            <div class="dish-details">
                                <!-- Heading -->
                                <h3>Паста</h3>
                                <!-- Paragraph -->
                                <p>Вкусные блюда с макаронных изделий и рызными соусами</p>
                                <!-- Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dishes-item-container">
                            <!-- Image Frame -->
                            <div class="img-frame">
                                <!-- Image -->
                                <img src="img/dish/dish6.jpg" class="img-responsive" alt=""/>
                                <!-- Block for on hover effect to image -->
                                <div class="img-frame-hover">
                                    <!-- Hover Icon -->
                                    <a href="index.php#"><i class="fa fa-cutlery"></i></a>
                                </div>
                            </div>
                            <!-- Dish Details -->
                            <div class="dish-details">
                                <!-- Heading -->
                                <h3>Куриные крылышки</h3>
                                <!-- Paragraph -->
                                <p>Быстрое приготовление и красивая подача</p>
                                <!-- Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dishes-item-container">
                            <!-- Image Frame -->
                            <div class="img-frame">
                                <!-- Image -->
                                <img src="img/dish/dish7.jpg" class="img-responsive" alt=""/>
                                <!-- Block for on hover effect to image -->
                                <div class="img-frame-hover">
                                    <!-- Hover Icon -->
                                    <a href="index.php#"><i class="fa fa-cutlery"></i></a>
                                </div>
                            </div>
                            <!-- Dish Details -->
                            <div class="dish-details">
                                <!-- Heading -->
                                <h3>Сырные продукты</h3>
                                <!-- Paragraph -->
                                <p>Блюди из сырных продуктов на любой вкус</p>
                                <!-- Button -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="dishes-item-container">
                            <!-- Image Frame -->
                            <div class="img-frame">
                                <!-- Image -->
                                <img src="img/dish/dish8.jpg" class="img-responsive" alt=""/>
                                <!-- Block for on hover effect to image -->
                                <div class="img-frame-hover">
                                    <!-- Hover Icon -->
                                    <a href="index.php#"><i class="fa fa-cutlery"></i></a>
                                </div>
                            </div>
                            <!-- Dish Details -->
                            <div class="dish-details">
                                <!-- Heading -->
                                <h3>Пицца</h3>
                                <!-- Paragraph -->
                                <p>Множество разных видов пиццы по лучшим мировым рецептам</p>
                                <!-- Button -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dishes End -->

    </div><!-- / Main Content End -->

    <!-- Footer Start -->

<?php include_once('footer.php'); ?>