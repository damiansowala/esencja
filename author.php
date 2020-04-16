<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<?php if ( have_posts() ): the_post(); ?>
<h1>
    <?php echo __('Author Archives:'); ?> <?php echo get_the_author() ; ?>
</h1>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
<h2>
    <?php echo __('About'); ?> <?php echo get_the_author() ; ?>
</h2>
<?php the_author_meta( 'description' ); ?>
<?php endif; ?>
<ul class="media-list">
    <?php rewind_posts(); while ( have_posts() ) : the_post(); ?>
    <li class="media">
        <div class="media-body">
            <h2 class="media-heading">
                <a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                </a>
            </h2>
            <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
                <?php the_date(); ?> <?php the_time(); ?>
            </time>
            <?php comments_popup_link(__('Leave a Comment'), __('1 Comment'), __('% Comments')); ?>
            <?php the_content(); ?>
        </div>
    </li>
    <?php endwhile; ?>
</ul>
<?php else: ?>
<h1>
    <?php echo __('No posts to display for'); ?> <?php echo get_the_author() ; ?>
</h1>
<?php endif; ?>
<?php BsWp::get_template_parts( array('footer' ) ); ?>