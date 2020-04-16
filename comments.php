<div id="comments">
    <?php if ( post_password_required() ) : ?>
    <p>
        This post is password protected. Enter the password to view any comments
    </p>
</div>
<?php
			return;
		endif;
	?>
<?php if ( have_comments() ) : ?>
<h2>
    <?php comments_number(); ?>
</h2>
<ul class="media-list">
    <?php wp_list_comments( array( 'callback' => 'bootstrap_comment' ) ); ?>
</ul>
<?php
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
<p>
    <?php echo __('Comments are closed')?>
</p>
<?php endif; ?>
<?php
	ob_start();
	$commenter = wp_get_current_commenter();
	$req = true;
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$comments_arg = array(
		'form'	=> array(
			'class' => 'form-horizontal'
			),'label_submit'=>__('DODAJ'),
		'fields' => apply_filters( 'comment_form_default_fields', array(
				'autor' 				=> '<div class="form-group">' .
										'<input id="author" name="author" class="form-control" type="text" value="" placeholder="Imię i nazwisko" size="30"' . $aria_req . ' />'.
										'<p id="d1" class="text-danger"></p>' . '</div>',
				'email'					=> '<div class="form-group">' . 
										'<input id="email" name="email" class="form-control" type="text" value="" placeholder="E-mail" size="30"' . $aria_req . ' />'.
										'<p id="d2" class="text-danger"></p>' . '</div>',
				'url'					=> '<div class="form-group">' . 
										'<input id="url" name="url" class="form-control" type="text" value="" placeholder="Strona WWW" size="30"' . $aria_req . ' />'.
										'<p id="d4" class="text-danger"></p>' . '</div>')),
				'comment_field'			=> '<div class="form-group">' .
										'<textarea id="comment" class="form-control" name="comment" rows="3" placeholder="Treść komentarza" aria-required="true"></textarea><p id="d3" class="text-danger"></p>' . '</div>',
				'comment_notes_after' 	=> '',
				'class_submit'			=> 'btn btn-primary'
			); ?>
<?php comment_form($comments_arg);
	echo str_replace('class="comment-form"','class="comment-form" name="commentForm" onsubmit="return validateForm();"',ob_get_clean());
	?>
<script>
function validateForm() {
    var form = document.forms["commentForm"];
    x = form["author"].value,
        y = form["email"].value,
        z = form["comment"].value,
        flag = true,
        d1 = document.getElementById("d1"),
        d2 = document.getElementById("d2"),
        d3 = document.getElementById("d3");
    if (x == null || x == "") {
        d1.innerHTML = "<?php echo __('Imię i nazwisko są wymagane'); ?>";
        z = false;
    } else {
        d1.innerHTML = "";
    }
    if (y == null || y == "") {
        d2.innerHTML = "<?php echo __('Adres e-mail jest wymagany'); ?>";
        z = false;
    } else {
        d2.innerHTML = "";
    }
    if (z == null || z == "") {
        d3.innerHTML = "<?php echo __('Treść komentarza jest wymagana'); ?>";
        z = false;
    } else {
        d3.innerHTML = "";
    }
    if (z == false) {
        return false;
    }
}
</script>
</div>