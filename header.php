<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">
    <title>
        <?php wp_title( '|', true, 'right' ); ?>
    </title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <?php
                    wp_nav_menu( array(
                        'menu'          	=> 'top_menu',
                        'theme_location'	=> 'top_menu',
                        'depth'         	=> 2,
                        'container'			=> false,
                        'menu_class'    	=> 'navbar-nav',
                        'fallback_cb'   	=> 'bs4navwalker::fallback',
                        'walker'         	=> new bs4navwalker())
                    );
		             ?>
                <span class="navbar-text">
                    <?php socialMedia(); ?>
                </span>
            </div>
        </div>
    </nav>