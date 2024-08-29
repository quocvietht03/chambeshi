<article <?php post_class('bt-post'); ?>>
	<div class="bt-post--featured-wrap">
		<?php echo chambeshi_post_featured_render('full'); 
			echo chambeshi_post_category_render();
		?>
	</div>
	<div class="bt-post--infor">
	<?php
	echo chambeshi_post_publish_render();
	if (is_single()) {
		echo chambeshi_single_post_title_render();
	} else {
		echo chambeshi_post_title_render();
	}
	echo chambeshi_post_meta_render();
	?>
	</div>
	<?php
	echo chambeshi_post_content_render();
	?>
</article>