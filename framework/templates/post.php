<?php
$post_id = get_the_ID();
$categories = get_the_terms($post_id, 'category');
?>
<article <?php post_class('bt-post'); ?>>
	<?php echo chambeshi_post_featured_render('full');
	?>
	<div class="bt-post--infor">
		<?php echo chambeshi_post_publish_render(); ?>
		<div class="bt-post--inner">
			<?php
			if ($categories && !is_wp_error($categories)) {
				echo '<div class="bt-post--category">';
				foreach ($categories as $cat) {
					echo '<a href="' . get_tag_link($cat->term_id) . '">' . $cat->name . '</a> ';
				}
				echo '</div>';
			}
			?>
			<?php if (is_single()) {
				echo chambeshi_single_post_title_render();
			} else {
				echo chambeshi_post_title_render();
			}
			echo chambeshi_post_meta_render();
			?>
			<?php
			echo chambeshi_post_content_render();
			?>
		</div>

	</div>

</article>