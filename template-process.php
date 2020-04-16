<?php
/*
* Template Name: Proces realizacji
*/
?>
<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-7 mt-4">
            <img class="img-fluid mb-3" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php endwhile; ?>
<div class="section_block">
    <?php if ( have_rows( 'proces_krok_po_kroku' ) ): ?>
    <?php while ( have_rows( 'proces_krok_po_kroku' ) ) : the_row(); ?>
    <?php if ( get_row_layout() == 'jeden_akapit' ) : ?>
    <?php $obraz = get_sub_field( 'obraz' ); ?>
    <?php if ( $obraz ) { ?>
    <section class="section_block-test section_block-test-small">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-11">
                    <h6><?php the_sub_field( 'tytul' ); ?></h6>
                    <div class="row">
                        <?php $ikona = get_sub_field( 'ikona' ); ?>
                        <?php if ( $ikona ) { ?>
                        <div class="col-12 col-md-2">
                            <div class="icon">
                                <img src="<?php echo $ikona['url']; ?>" alt="<?php echo $ikona['alt']; ?>" />
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-12 col-md-8 col-lg-10">
                            <p> <?php the_sub_field( 'tresc' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <span class="time"><?php the_sub_field( 'czas_trwania' ); ?></span>
        </div>
        <img class="cover-foto" src="<?php echo $obraz['url']; ?>" alt="<?php echo $obraz['alt']; ?>" />
    </section>
    <?php } ?>
    <?php elseif ( get_row_layout() == 'dwa_akapity' ) : ?>
    <?php $imgTwo = get_sub_field( 'obraz' ); ?>
    <?php if ( $imgTwo ) { ?>
    <section class="section_block-test section_block-test-big">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-11">
                    <?php if ( have_rows( 'pierwszy_akapit' ) ) : ?>
                    <?php while ( have_rows( 'pierwszy_akapit' ) ) : the_row(); ?>
                    <h6><?php the_sub_field( 'tytul' ); ?></h6>
                    <div class="row">
                        <?php $ikona = get_sub_field( 'ikona' ); ?>
                        <?php if ( $ikona ) { ?>
                        <div class="col-12 col-md-2">
                            <div class="icon">
                                <img src="<?php echo $ikona['url']; ?>" alt="<?php echo $ikona['alt']; ?>" />
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-12 col-md-8 col-lg-10">
                            <p> <?php the_sub_field( 'tresc' ); ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                    <?php if ( have_rows( 'drugi_akapit' ) ) : ?>
                    <?php while ( have_rows( 'drugi_akapit' ) ) : the_row(); ?>
                    <h6><?php the_sub_field( 'tytul' ); ?></h6>
                    <div class="row">
                        <?php $ikona = get_sub_field( 'ikona' ); ?>
                        <?php if ( $ikona ) { ?>
                        <div class="col-12 col-md-2">
                            <div class="icon">
                                <img src="<?php echo $ikona['url']; ?>" alt="<?php echo $ikona['alt']; ?>" />
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-12 col-md-8 col-lg-10">
                            <p> <?php the_sub_field( 'tresc' ); ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <span class="time"><?php the_sub_field( 'czas_trwania' ); ?></span>
        </div>
        <img class="cover-foto" src="<?php echo $imgTwo['url']; ?>" alt="<?php echo $imgTwo['alt']; ?>" />
    </section>
    <?php } ?>
    <?php endif; ?>
    <?php endwhile; ?>
    <?php elseif ( get_row_layout() == 'header' ) : ?>
    <h2 class="h2"> <?php the_sub_field( 'header' ); ?></h2>
    <?php endif; ?>
</div>
<section class="container-fluid section_realizations">
    <h2 class="h2 h2--accent"> <?php echo __('Ostatnie realizacje'); ?> </h2>
    <div class="container">
        <div class="row">
            <?php $the_query = new WP_Query(getRealizations()); ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php $img = get_the_post_thumbnail_url(get_the_ID(), 'medium' ); ?>
            <?php if ( $img ) : ?>
            <div class="col-6 col-md">
                <a href="<?php galleryLink(); ?>">
                    <div class="img-hover-zoom">
                        <img src=" <?php the_post_thumbnail_url( 'medium' ); ?> " alt="<?php the_title(); ?>" />
                    </div>
                </a>
            </div>
            <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="container-fluid section_blog">
    <div class="container">
        <h3 class="h2">Blog</h3>
        <div class="row justify-content-center">
            <?php $the_query = new WP_Query(getPostBlog()); ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <?php $img = get_the_post_thumbnail_url(get_the_ID(), 'medium' ); ?>
            <?php if ( $img ) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a class="section_blog-article" href="<?php the_permalink(); ?>" title="Czytaj - <?php the_title(); ?>">
                    <div class="img-hover-zoom">
                        <img src=" <?php the_post_thumbnail_url( 'medium' ); ?> " alt="" />
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