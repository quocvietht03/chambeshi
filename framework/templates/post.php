<?php
$post_id = get_the_ID();
$tags = get_the_terms($post_id, 'post_tag');
?>
<article <?php post_class('bt-post'); ?>>
	<?php echo chambeshi_post_featured_render('full');
	?>
	<div class="bt-post--infor">
		<?php echo chambeshi_post_publish_render(); ?>
		<div class="bt-post--inner">
			<?php
			if ($tags && !is_wp_error($tags)) {
				echo '<div class="bt-post--tags">';
				foreach ($tags as $tag) {
					echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a> ';
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