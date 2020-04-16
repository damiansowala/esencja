<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="container">
    <div class="row">
        <h2 class="h2">
            <b><?php echo __('Blog'); ?></b> - <?php the_title(); ?>
        </h2>
        <div class="col-12 col-lg-10">
            <div class="row">
                <div class="col-12 col-md-6">
                    <span class="section_blog-article-info">
                        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
                            <i class="far fa-calendar-alt"></i> <?php echo __(get_the_date() ); ?>
                        </time>
                        <span>
                            <i class="far fa-comment"></i>
                            <?php commentsNumber(); ?>
                        </span>
                        <span>
                            <i class="far fa-eye"></i>
                            <?php echo gt_get_post_view(); ?>
                        </span>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-2 section_post-menu">
            <?php get_search_form(); ?>
            <h3> <?php echo __('Kategorie:'); ?></h3>
            <ul>
                <?php wp_list_categories(getCategory()); ?>
            </ul>
            <?php $the_query = new WP_Query(getLastPostBlog()); ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <h3> <?php echo __('Ostatnie wpisy:'); ?></h3>
            <ul>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
<section class="container line">
    <div class="row">
        <div class="col-12 col-md-7">
            <?php comments_template( '', true ); ?>
        </div>
    </div>
</section>
<?php endwhile; ?>
<section class="container-fluid section_blog">
    <div class="container">
        <h3 class="h2"><?php echo __('Najnowsze wpisy'); ?></h3>
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
                        <h2 class="text-center"> <?php the_title(); ?></h2>
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