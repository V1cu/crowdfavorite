<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="profile" href="https://gmpg.org/xfn/11"/>

    <?php wp_head(); ?>

    <?php wp_body_open(); ?>

    <div class="wrapper">

        <div class="preloader">
            <div class="loader">
                <div class="ytp-spinner">
                    <div class="ytp-spinner-container">
                        <div class="ytp-spinner-rotator">
                            <div class="ytp-spinner-left">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                            <div class="ytp-spinner-right">
                                <div class="ytp-spinner-circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <header class="header-area">
            <div class="navbar-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="/">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg"
                                         alt="Logo">
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'main-menu',
                                        'menu_id' => 'nav',
                                        'menu_class' => 'navbar-nav ml-auto',
                                        'container' => 'nav',
                                        'container_class' => 'collapse navbar-collapse sub-menu-bar',
                                        'container_id' => 'navbarSupportedContent',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker' => new \CF\Libraries\MainNavWalker()
                                    )
                                );
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
