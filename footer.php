<footer class="container-fluid footer">
    <h2 class="h2 h2--light"> <?php echo __('Kontakt'); ?> </h2>
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <?php logo(); ?>
                <div class="footer_contact">
                    <p> <a class=""
                            href="mailto: <?php the_field( 'e-mail', 16 ); ?>"><?php the_field( 'e-mail', 16 ); ?>
                        </a>
                    </p>
                    <p> <a class=""
                            href="tel: +48 <?php the_field( 'telefon', 16 ); ?>"><?php the_field( 'telefon', 16 ); ?>
                        </a></p>
                </div>
                <?php socialMedia(); ?>
            </div>
            <div class="col-12 col-lg-3">
                <?php echo do_shortcode('[contact-form-7 id="5" title="Formularz kontaktowy"]'); ?>
            </div>
        </div>
    </div>
    <div class="autor-link">
        <a href="https://coolbrand.pl" rel="nofollow">Coolbrand.pl © 2019
        </a>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>