<?php
/**
 * Project: restaurant
 * Filename: footer.php
 * Date: 16.05.2019
 * Time: 8:33
 */
?>
<!-- Footer Start -->

<div class="footer padd">
    <div class="container">
        <!-- Copyright -->
        <div class="footer-copyright">
            <!-- Paragraph -->
            <p><?php echo "&copy;" . " " . date("Y"); ?> <a href="index.html#">Restaurant</a></p>
        </div>
    </div>
</div>

<!-- Footer End -->

</div><!-- / Wrapper End -->


<!-- Scroll to top -->
<span class="totop"><a href="index.html#"><i class="fa fa-angle-up"></i></a></span>


<!-- Javascript files -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap JS -->
<script src="js/bootstrap.min.js"></script>
<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>
<!-- FLEX SLIDER SCRIPTS  -->
<script defer src="js/jquery.flexslider-min.js"></script>
<!-- Pretty Photo JS -->
<script src="js/jquery.prettyPhoto.js"></script>
<!-- Respond JS for IE8 -->
<script src="js/respond.min.js"></script>
<!-- HTML5 Support for IE -->
<script src="js/html5shiv.js"></script>
<!-- Custom JS -->
<script src="js/custom.js"></script>
<!-- JS code for this page -->
<script>
    /* ******************************************** */
    /*  JS for SLIDER REVOLUTION  */
    /* ******************************************** */
    jQuery(document).ready(function () {
        jQuery('.tp-banner').revolution(
            {
                delay: 9000,
                startheight: 500,

                hideThumbs: 10,

                navigationType: "bullet",


                hideArrowsOnMobile: "on",

                touchenabled: "on",
                onHoverStop: "on",

                navOffsetHorizontal: 0,
                navOffsetVertical: 20,

                stopAtSlide: -1,
                stopAfterLoops: -1,

                shadow: 0,

                fullWidth: "on",
                fullScreen: "off"
            });
    });
    /* ******************************************** */
    /*  JS for FlexSlider  */
    /* ******************************************** */

    $(window).load(function () {
        $('.flexslider-recent').flexslider({
            animation: "fade",
            animationSpeed: 1000,
            controlNav: true,
            directionNav: false
        });
        $('.flexslider-testimonial').flexslider({
            animation: "fade",
            slideshowSpeed: 5000,
            animationSpeed: 1000,
            controlNav: true,
            directionNav: false
        });
    });

    /* Gallery */

    jQuery(".gallery-img-link").prettyPhoto({
        overlay_gallery: false, social_tools: false
    });

</script>
</body>
</html>
