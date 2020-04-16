<?php
/*
* Template Name: Blog
*/
?>
<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<div class="container">
    <div class="row">
        <?php $the_query = new WP_Query(getAllPostBlog()); ?>
        <?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
        <div class="col-12 col-md-6">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div class="card-body">
                    <img src=" <?php the_post_thumbnail_url( 'medium' ); ?> "
                        alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true );?>"
                        class="card-img img-fluid">
                    <div class="d-flex justify-content-between">
                        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
                            <i class="far fa-calendar-alt"></i> <?php the_date(); ?>
                        </time>
                        <span>
                            <i class="far fa-comment"></i>
                            <?php comments_popup_link(__('Leave a Comment'), __('1 Comment'), __('% Comments')); ?>
                        </span>
                        <span>
                            <i class="far fa-eye"></i> wyswietleń
                        </span>
                    </div>
                    <article>
                        <h2 class="card-title text-center"> <?php the_title(); ?></h2>
                        <p class="card-text"> <?php echo get_the_excerpt(); ?></p>
                    </article>
                </div>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php BsWp::get_template_parts( array('footer' ) ); ?>