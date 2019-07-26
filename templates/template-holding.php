<?php
/**
 * Template Name: Holding Template
 */
?>

<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#ffffff">

    <style>
        #global {
            width: 70px;
            margin: auto;
            position: relative;
            cursor: pointer;
            height: 60px;
        }

        .mask {
            position: absolute;
            border-radius: 2px;
            overflow: hidden;
            perspective: 1000;
            backface-visibility: hidden;
        }

        .plane {
            background: #ffffff;
            width: 400%;
            height: 100%;
            position: absolute;
            transform: translate3d(0px, 0, 0);
            /*transition: all 0.8s ease; */
            z-index: 100;
            perspective: 1000;
            backface-visibility: hidden;

        }

        #top .plane {
            z-index: 2000;
            animation: trans1 1.3s ease-in infinite 0s backwards;
        }

        #middle .plane {
            transform: translate3d(0px, 0, 0);
            background: #bbbbbb;
            animation: trans2 1.3s linear infinite 0.3s backwards;

        }

        #bottom .plane {
            z-index: 2000;
            animation: trans3 1.3s ease-out infinite 0.7s backwards;
        }

        #top {
            width: 53px;
            height: 20px;
            left: 20px;
            transform: skew(-15deg, 0);
            z-index: 100;
        }

        #middle {
            width: 33px;
            height: 20px;
            left: 20px;
            top: 15px;

            transform: skew(-15deg, 40deg)
        }

        #bottom {
            width: 53px;
            height: 20px;
            top: 30px;
            transform: skew(-15deg, 0)
        }

        p {
            color: #fff;
            position: absolute;
            left: -3px;
            top: 45px;
            font-family: Arial;
            text-align: center;
            font-size: 10px;
        }

        @keyframes trans1 {
            from {
                transform: translate3d(53px, 0, 0)
            }
            to {
                transform: translate3d(-250px, 0, 0)
            }
        }

        @keyframes trans2 {
            from {
                transform: translate3d(-160px, 0, 0)
            }
            to {
                transform: translate3d(53px, 0, 0)
            }
        }

        @keyframes trans3 {
            from {
                transform: translate3d(53px, 0, 0)
            }
            to {
                transform: translate3d(-220px, 0, 0)
            }
        }

        @keyframes animColor {
            from {
                background: red;
            }
            25% {
                background: yellow;
            }
            50% {
                background: green;
            }
            75% {
                background: brown;
            }
            to {
                background: blue;
            }
        }

        .preloader {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background-color: #000;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

    </style>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'holder lazy' ) ?>
        data-src="<?php echo get_template_directory_uri() . '/assets/img/holder-bg.jpg' ?>">
<div class="preloader">
    <section id="global">

        <div id="top" class="mask">
            <div class="plane"></div>
        </div>
        <div id="middle" class="mask">
            <div class="plane"></div>
        </div>

        <div id="bottom" class="mask">
            <div class="plane"></div>
        </div>


    </section>
</div>
<div class="overlay overlay-grad"></div>
<div class="holder-wrapper">
    <div class="logo text-center">
        <img src="<?php echo get_template_directory_uri() . '/assets/img/holder-logo.svg'; ?>" alt="OpenWorldRelief">
    </div>
    <div class="contact-form-wrapper">
        <div class="contact-form">
            <div class="title">
                OpenWorld Relief's website is under development
            </div>
            <div class="sub-title">
                Let us know the best email to reach you and we'll reach out when the site is live
            </div>
			<?php echo do_shortcode( '[contact-form-7 id="6" title="Contact form 1"]' ) ?>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>