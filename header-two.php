<div class="container header">
    <div class="row">
        <a class="navbar-brand" href="<?php echo get_site_url(); ?>">
            <h1><?php logo(); ?></h1>
        </a>
        <a class="header_phone" href="tel: +48 <?php the_field( 'telefon', 16 ); ?>">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/telefon.png" alt="telefon, esencja wnętrz">
            <span><?php echo __('Umów sie <br> na spotaknie'); ?></span>
            <b><?php the_field( 'telefon',16 ); ?></b>
        </a>
    </div>
</div>