<?php
/*
* Template Name: Projekty i realizacje
*/
?>
<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $the_query = new WP_Query(getFullRealizations()); ?>
<div class="container">
    <?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <h2 class="h2"><?php the_title(); ?></h2>
    <div class="section_gallery">
        <?php $galeria_images = get_field( 'galeria' ); ?>
        <?php if ( $galeria_images ) :  ?>
        <?php foreach ( $galeria_images as $galeria_image ): ?>
        <a class="section_gallery-images" href="<?php echo $galeria_image['url']; ?>" data-lightbox="roadtrip">
            <img src="<?php echo $galeria_image['sizes']['large']; ?>" alt="<?php echo $galeria_image['alt']; ?>" />
            <span>
                <p><?php echo $galeria_image['title']; ?></p>
            </span>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</div>
<?php endwhile; ?>
<?php BsWp::get_template_parts( array('footer' ) ); ?>