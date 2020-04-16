<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<section id="blog" class="container">
    <div class="row">
        <h2 class="h2"><b>BLOG - </b>Wszytskie wpisy</h2>
        <div class="col-12 col-lg-10">
            <div class="row">
                <?php $the_query = new WP_Query(getAllPostBlog()); ?>
                <?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
                <div class="col-12 col-md-6 section_blog">
                    <a class="section_blog-article" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <div class="img-hover-zoom">
                            <img src=" <?php the_post_thumbnail_url( 'large' ); ?> "
                                alt="<?php echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true );?>">
                        </div>
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
                        <article>
                            <h2 class="text-center"> <?php the_title(); ?></h2>
                            <p> <?php echo get_the_excerpt(); ?></p>
                        </article>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="col-12 col-lg-2 section_post-menu">
            <?php get_search_form(); ?>
            <label> <?php echo __('Kategorie:'); ?></label>
            <ul>
                <?php wp_list_categories(getCategory()); ?>
            </ul>
            <?php $the_query = new WP_Query(getLastPostBlog()); ?>
            <?php if ( $the_query->have_posts() ) : ?>
            <label> <?php echo __('Ostatnie wpisy:'); ?></label>
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
    <nav class="pagination">
        <?php pagination_bar(); ?>
    </nav>
</section>
<?php BsWp::get_template_parts( array( 'footer' ) ); ?>