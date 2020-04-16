<?php
/*
* Template Name: Zanim kupisz mieszkanie
*/
?>
<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="container section_text">
    <div class="row">
        <h2 class="h2"> <?php the_title(); ?> </h2>
        <div class="col-12">
            <img class="img-fluid mb-3" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php if ( have_rows( 'steps', 138 ) ) : ?>
<section class="container section_steps">
    <h2 class="h2"><?php the_field( 'header_steps', 138 ); ?></h2>
    <div class="row justify-content-center">
        <?php while ( have_rows( 'steps', 138 ) ) : the_row(); ?>
        <?php $ikona = get_sub_field( 'ikona' ); ?>
        <?php if ( $ikona ) { ?>
        <div class="col-6 col-md-2">
            <a href="<?php the_sub_field( 'link' ); ?>">
                <span><?php echo get_row_index(); ?></span>
                <div class="card">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg-5-steps.png" class="card-img"
                        alt="...">
                    <div class="card-img-overlay">
                        <img src=" <?php echo $ikona['url']; ?>" alt="<?php echo $ikona['alt']; ?>" />
                    </div>
                </div>
                <p> <?php the_sub_field( 'nazwa_kroku' ); ?> </p>
            </a>
        </div>
        <?php } ?>
        <?php endwhile; ?>
    </div>
    <?php if ( get_field( 'tekst_linku', 138 ) ) : ?>
    <a class="nav-link"
        href="<?php the_field( 'link_do_strony', 138 ); ?>"><?php the_field( 'tekst_linku', 138 ); ?></a>
    <?php endif; ?>
</section>
<?php endif; ?>
<?php $img_info = get_field( 'img_info' ); ?>
<?php if ( $img_info ) { ?>
<section class="section_block-test">
    <img class="token" src="<?php echo get_template_directory_uri(); ?>/images/token.png" alt="">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-10">
                <div class="row">
                    <p><?php the_field( 'text_info' ); ?></p>
                </div>
            </div>
        </div>
    </div>
    <img class="cover-foto" src="<?php echo $img_info['url']; ?>" alt="<?php echo $img_info['alt']; ?>" />
</section>
<?php } ?>
<section class="container-fluid section_blog">
    <div class="container">
        <h3 class="h2">BLOG</h3>
        <div class="row justify-content-center">
            <?php $the_query = new WP_Query(getPostBlog()); ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php $img = get_the_post_thumbnail_url(get_the_ID(), 'medium' ); ?>
            <?php if ( $img ) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a class="section_blog-article" href="<?php the_permalink(); ?>" title="Czytaj - <?php the_title(); ?>">
                    <div class="img-hover-zoom">
                        <img src=" <?php the_post_thumbnail_url( 'medium' ); ?> " alt="<?php the_title(); ?>" />
                    </div>
                    <article>
                        <h2> <?php the_title(); ?></h2>
                        <p> <?php echo get_the_excerpt(); ?></p>
                    </article>
                </a>
            </div>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php BsWp::get_template_parts( array('footer' ) ); ?>