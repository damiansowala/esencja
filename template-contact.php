<?php
/*
* Template Name: Kontakt
*/
?>
<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="container header">
                <div class="row justify-content-center">
                    <a class="navbar-brand" href="<?php echo get_site_url(); ?>">
                        <h1><?php logo(); ?></h1>
                    </a>
                    <a class="header_phone" href="tel: +48 <?php the_field( 'telefon', 16 ); ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/telefon.png"
                            alt="telefon, esencja wnętrz">
                        <span><?php echo __('Umów sie <br> na spotaknie'); ?></span>
                        <b><?php the_field( 'telefon',16 ); ?></b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7 mt-4">
            <img class="img-fluid mb-3" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            <?php the_content(); ?>
        </div>
    </div>
</div>

<?php endwhile; ?>
<?php BsWp::get_template_parts( array('footer' ) ); ?>