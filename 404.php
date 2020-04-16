<?php BsWp::get_template_parts( array(  'header' ) ); ?>
<?php BsWp::get_template_parts( array(  'header-two' ) ); ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h2>
                <?php echo __('Page not found'); ?>
            </h2>
            <a href="<?php echo get_site_url(); ?>" class="btn btn-primary">Strona głowna</a>
        </div>
    </div>
</div>
<?php BsWp::get_template_parts( array('footer' ) ); ?>