<?php
get_header();
get_template_part('framework/templates/site', 'titlebar');

?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<div class="bt-form-search">
			<?php get_search_form(); ?>
			</div>
			<?php
			if (have_posts()) {
			?>
				<div class="bt-list-post-grid">
					<?php
					while (have_posts()) : the_post();
					get_template_part( 'framework/templates/post', 'style', array('image-size' => 'large')); 
					endwhile;
					?>
				</div>
			<?php
				chambeshi_paging_nav();
			} else {
				get_template_part('framework/templates/post', 'none');
			}
			?>
		</div>
	</div>

</main><!-- #main -->

<?php get_footer(); ?>