<?php
/*
Template Name: 404 Template
*/
?>
<?php get_header();
get_template_part('framework/templates/site', 'titlebar');
?>

<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<div class="bt-404-page">
				<div class="bt-404--infor">
					<span><?php esc_html_e('Sorry! This Page Was Lost', 'chambeshi'); ?></span>
					<h3><span><?php esc_html_e('Oppoos...', 'chambeshi'); ?></span><?php esc_html_e('Page Not Found!', 'chambeshi'); ?></h3>
					<p><?php esc_html_e('The page you looking for not found may be it not exist or removed.', 'chambeshi'); ?></p>
					<a class="bt-button" href="<?php echo home_url('/'); ?>"><?php esc_html_e('Back To Home', 'chambeshi'); ?></a>
				</div>
				<div class="bt-404--image">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/404-min.jpg" alt="" />
				</div>
			</div>
		</div>
	</div>
</main><!-- #main -->
<?php get_footer(); ?>