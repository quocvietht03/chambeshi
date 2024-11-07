<?php
/*
 * Single Service
 */

get_header();
get_template_part('framework/templates/site', 'titlebar');
$post_id = get_the_ID();

$top_service = get_field('top_services', 'options');
$make_appointment = get_field('make_appointment', 'options');
$opening_hours_sidebar = get_field('opening_hours_sidebar', 'options');
$site_information = get_field('site_information', 'options');
$testimonials_section = get_field('testimonials_section', 'options');
$phone_sv = get_field('phone_sv', 'option');

$thumb = '';
$icon_lively = get_field('icon_lively_service', $post_id);
$icon_service = get_field('icon_service', $post_id);

if (!empty($icon_lively)) {
	$thumb = $icon_lively['url'];
} elseif (!empty($icon_service)) {
	$thumb = $icon_service['url'];
}

$id_elementor = '';
if (function_exists('get_field')) {
	$id_elementor = get_field('service_templates_elementor', 'option');
}
?>
<main id="bt_main" class="bt-site-main">
	<div class="bt-main-content-ss">
		<div class="bt-container">
			<?php while (have_posts()):
				the_post(); ?>
				<div class="bt-main-post-row">
					<div class="bt-sidebar-col">
						<div class="bt-sidebar-wrap">
							<div class="bt-sidebar-block bt-top-service-block">
								<h3 class="bt-block-heading">
									<?php
									if (!empty($top_service['heading'])) {
										echo esc_html($top_service['heading']);
									} else {
										echo esc_html__('Top Services', 'chambeshi');
									}
									?>
								</h3>
								<ul class="bt-service-list">
									<?php
									$args = array(
										'post_type' => 'service',
										'posts_per_page' => -1,
										'posts_per_page' => !empty($top_service['number_posts']) ? $top_service['number_posts'] : -1,
									);
									$popular_services = $top_service['popular_service'];
									if ($popular_services) {
										$popular_service_ids = array();
										foreach ($popular_services as $post) {
											$popular_service_ids[] = $post->ID;
										}
										$args['post__in'] = $popular_service_ids;
									}
									$query = new WP_Query($args);
									if ($query->have_posts()) {
										while ($query->have_posts()) {
											$query->the_post();
									?>
											<li class="bt-service-list--item <?php if ($post_id == get_the_ID()) {
																					echo 'active';
																				} ?>">
												<a href="<?php echo get_the_permalink(get_the_ID()); ?>"
													class="bt-service-list--content">
													<h3 class="bt-service-list--title"><?php echo get_the_title(get_the_ID()); ?></h3>
													<div class="bt-service-list--icon">
														<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
															viewBox="0 0 22 22" fill="none">
															<path
																d="M20.8146 10.352L14.3979 3.9353C14.225 3.76832 13.9935 3.67592 13.7531 3.67801C13.5128 3.6801 13.2829 3.77651 13.1129 3.94646C12.943 4.11642 12.8466 4.34633 12.8445 4.58668C12.8424 4.82703 12.9348 5.05858 13.1018 5.23146L17.9537 10.0834H1.83317C1.59006 10.0834 1.3569 10.18 1.18499 10.3519C1.01308 10.5238 0.916504 10.7569 0.916504 11C0.916504 11.2432 1.01308 11.4763 1.18499 11.6482C1.3569 11.8201 1.59006 11.9167 1.83317 11.9167H17.9537L13.1018 16.7686C13.0142 16.8532 12.9444 16.9543 12.8963 17.0662C12.8483 17.178 12.823 17.2983 12.8219 17.42C12.8209 17.5417 12.8441 17.6624 12.8902 17.7751C12.9363 17.8877 13.0043 17.9901 13.0904 18.0762C13.1765 18.1622 13.2788 18.2303 13.3915 18.2764C13.5041 18.3225 13.6248 18.3457 13.7465 18.3446C13.8683 18.3436 13.9885 18.3183 14.1004 18.2702C14.2122 18.2222 14.3134 18.1523 14.3979 18.0648L20.8146 11.6481C20.9864 11.4762 21.083 11.2431 21.083 11C21.083 10.757 20.9864 10.5239 20.8146 10.352Z"
																fill="#FFE17F" />
														</svg>
													</div>
												</a>
											</li>
									<?php
										}

										wp_reset_postdata();
									}
									?>
								</ul>
							</div>
							<div class="bt-sidebar-block bt-calling-us-block">
								<div class="bt-calling-us">
									<svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 70 70"
										fill="none">
										<g clip-path="url(#clip0_23_3761)">
											<path
												d="M17.6417 0C16.8866 0 16.2744 0.612363 16.2744 1.36732C16.2744 2.12242 16.8866 2.73465 17.6417 2.73465C25.3654 2.73465 31.649 9.18135 31.649 17.1058C31.649 17.8609 32.2613 18.4732 33.0163 18.4732C33.7714 18.4732 34.3836 17.8608 34.3836 17.1058C34.3838 7.67361 26.8733 0 17.6417 0Z"
												fill="#4F6A35" />
											<path
												d="M17.6373 6.48682C16.8822 6.48682 16.27 7.09918 16.27 7.85414C16.27 8.60924 16.8822 9.22146 17.6373 9.22146C21.8667 9.22146 25.3075 12.7582 25.3075 17.1055C25.3075 17.8606 25.9199 18.4728 26.6749 18.4728C27.43 18.4728 28.0422 17.8604 28.0422 17.1055C28.0423 11.2504 23.3746 6.48682 17.6373 6.48682Z"
												fill="#4F6A35" />
											<path
												d="M17.6637 12.4626C16.9085 12.4626 16.2964 13.0747 16.2964 13.83C16.2964 14.5851 16.9088 15.1973 17.6637 15.1973C18.6518 15.1973 19.4554 16.0346 19.4554 17.0638C19.4554 17.8189 20.0676 18.4311 20.8227 18.4311C21.5778 18.4311 22.1901 17.8187 22.1901 17.0638C22.1902 14.5267 20.1595 12.4626 17.6637 12.4626Z"
												fill="#4F6A35" />
											<path
												d="M62.6839 10.8369H59.653C58.8979 10.8369 58.2856 11.4491 58.2856 12.2042C58.2856 12.9593 58.8979 13.5716 59.653 13.5716H62.6839C65.2096 13.5716 67.2645 15.6264 67.2645 18.1522V36.713C67.2645 38.1673 66.5824 39.4643 65.5224 40.304V36.7283C65.5224 33.9387 63.532 31.5427 60.7896 31.0312L59.9058 30.8665C60.1029 30.2622 60.2108 29.6182 60.2108 28.949V25.8069C60.2108 22.3905 57.4313 19.611 54.0148 19.611C50.5984 19.611 47.819 22.3905 47.819 25.8069V28.949C47.819 29.6182 47.927 30.2622 48.124 30.8665L47.2401 31.0312C44.4977 31.5426 42.5073 33.9386 42.5073 36.7283V40.6922C41.1254 39.9026 40.1912 38.4153 40.1912 36.713V18.1522C40.1912 15.6264 42.2461 13.5716 44.7718 13.5716H48.0306C48.7857 13.5716 49.398 12.9593 49.398 12.2042C49.398 11.4491 48.7856 10.8369 48.0306 10.8369H44.7718C40.7382 10.8369 37.4565 14.1186 37.4565 18.1522V36.713C37.4565 40.7466 40.7382 44.0283 44.7718 44.0283H51.6523V47.9596C51.6523 48.5118 51.9846 49.01 52.4944 49.2219C52.6642 49.2926 52.8425 49.3269 53.0194 49.3269C53.3737 49.3269 53.7222 49.1891 53.9835 48.9296L58.9158 44.0283H62.6839C66.7175 44.0283 69.9992 40.7466 69.9992 36.713V18.1522C69.9992 14.1186 66.7175 10.8369 62.6839 10.8369ZM50.5535 25.8069C50.5535 23.8983 52.1061 22.3456 54.0147 22.3456C55.9233 22.3456 57.476 23.8983 57.476 25.8069V28.949C57.476 30.8576 55.9233 32.4103 54.0147 32.4103C52.1061 32.4103 50.5535 30.8576 50.5535 28.949V25.8069ZM62.7874 41.2907C62.7528 41.2916 62.7185 41.2933 62.6836 41.2933H58.352V41.2936C57.9907 41.2936 57.6443 41.4365 57.3881 41.6909L54.387 44.6733V42.6608C54.387 41.9057 53.7746 41.2935 53.0196 41.2935H45.2421V36.7282C45.2421 35.255 46.2934 33.9896 47.7415 33.7194L49.6691 33.36C50.7883 34.4629 52.3231 35.1448 54.0148 35.1448C55.7064 35.1448 57.2415 34.4626 58.3607 33.3598L60.2884 33.7193C61.7367 33.9894 62.7878 35.2547 62.7878 36.7282V41.2907H62.7874Z"
												fill="#4F6A35" />
											<path
												d="M54.1474 11.2382C53.8932 10.9826 53.5404 10.8376 53.1808 10.8376C52.8212 10.8376 52.4684 10.9826 52.2141 11.2382C51.9598 11.4913 51.8135 11.8442 51.8135 12.205C51.8135 12.5645 51.9596 12.9174 52.2141 13.1717C52.4684 13.4259 52.8211 13.5723 53.1808 13.5723C53.5404 13.5723 53.8932 13.426 54.1474 13.1717C54.4017 12.916 54.5481 12.5647 54.5481 12.205C54.5481 11.844 54.4018 11.4925 54.1474 11.2382Z"
												fill="#4F6A35" />
											<path
												d="M25.4132 45.9973C25.1589 45.743 24.8075 45.5967 24.4464 45.5967C24.0869 45.5967 23.734 45.743 23.4798 45.9973C23.2255 46.2516 23.0791 46.6043 23.0791 46.964C23.0791 47.3249 23.2254 47.6764 23.4798 47.9307C23.7354 48.1864 24.0869 48.3326 24.4464 48.3326C24.806 48.3326 25.1589 48.1864 25.4132 47.9307C25.6688 47.6764 25.8137 47.3248 25.8137 46.964C25.8137 46.6044 25.6688 46.2517 25.4132 45.9973Z"
												fill="#4F6A35" />
											<path
												d="M55.3418 58.3612L44.8664 47.8857C43.4718 46.4912 41.278 46.2872 39.6505 47.4002L32.9647 51.9718C32.4221 52.3427 31.6912 52.2748 31.2262 51.8098L29.0153 49.5988C28.4816 49.0652 27.616 49.065 27.0814 49.5988C26.5476 50.1327 26.5476 50.9984 27.0814 51.5327L29.2923 53.7437C30.6869 55.1381 32.8804 55.3425 34.5081 54.2292L41.194 49.6577C41.7363 49.2868 42.4675 49.3546 42.9325 49.8196L53.408 60.2951C53.9411 60.828 53.9409 61.6957 53.4079 62.229C46.6906 68.9463 35.7606 68.9463 29.0434 62.229L7.77238 40.9578C4.5182 37.7037 2.72636 33.3774 2.72636 28.7754C2.72636 24.1735 4.51833 19.847 7.77251 16.5928C8.03078 16.3346 8.37408 16.1925 8.73925 16.1925C9.10457 16.1925 9.448 16.3347 9.70613 16.593L20.1815 27.0685C20.6462 27.5332 20.7143 28.2645 20.3435 28.807L15.7722 35.4928C14.6589 37.1205 14.8632 39.314 16.2576 40.7087L19.5809 44.032C20.1149 44.5658 20.9805 44.5658 21.5148 44.032C22.0487 43.4981 22.0487 42.6323 21.5148 42.0981L18.1914 38.7748C17.7267 38.3101 17.6586 37.5789 18.0296 37.0364L22.601 30.3506C23.7141 28.7228 23.5098 26.5291 22.1154 25.1347L11.64 14.6592C10.0407 13.0599 7.43824 13.0599 5.83863 14.6592C-1.94491 22.4429 -1.94491 35.1078 5.83863 42.8915L27.1096 64.1623C31.0014 68.0542 36.1135 70.0001 41.2255 70.0001C46.3377 70 51.4498 68.054 55.3416 64.1623C56.941 62.563 56.941 59.9607 55.3418 58.3612Z"
												fill="#4F6A35" />
											<path
												d="M18.4199 33.6216L10.1312 25.3329C9.59702 24.7992 8.73145 24.7992 8.19729 25.3329C7.6634 25.867 7.6634 26.7328 8.19729 27.2668L16.4861 35.5555C16.7531 35.8224 17.1029 35.956 17.453 35.956C17.8029 35.956 18.1529 35.8224 18.4199 35.5555C18.9538 35.0215 18.9538 34.1557 18.4199 33.6216Z"
												fill="#4F6A35" />
											<path
												d="M50.1433 65.3451L41.4222 56.6239C40.888 56.0902 40.0225 56.0902 39.4883 56.6239C38.9544 57.158 38.9544 58.0238 39.4883 58.5578L48.2095 67.279C48.4765 67.5459 48.8262 67.6794 49.1763 67.6794C49.5262 67.6794 49.8762 67.5459 50.1433 67.279C50.6772 66.7448 50.6772 65.8791 50.1433 65.3451Z"
												fill="#4F6A35" />
										</g>
										<defs>
											<clipPath id="clip0_23_3761">
												<rect width="70" height="70" fill="white" />
											</clipPath>
										</defs>
									</svg>
									<div class="bt-calling-us--phone">

										<div class="bt-calling-us--phone-infor">
											<div class="bt-label">
												<?php
												if (!empty($phone_sv['label'])) {
													echo esc_html($phone_sv['label']);
												} else {
													echo esc_html__('Any questions?', 'chambeshi');
												}
												?>
											</div>
											<div class="bt-sub-label">
												<?php
												if (!empty($phone_sv['sub_label'])) {
													echo esc_html($phone_sv['sub_label']);
												} else {
													echo esc_html__('Please call us at the number provided below.', 'chambeshi');
												}
												?>
											</div>
											<div class="bt-head">
												<a
													href="<?php echo esc_url('tel:' . preg_replace('/[^0-9]+/', '', $site_information['site_phone'])); ?>">
													<?php echo esc_html($site_information['site_phone']); ?>
												</a>
											</div>
											<?php
											if (!empty($phone_sv['cta_text']) && !empty($phone_sv['cta_url'])) {
												echo '<a class="bt-cta" href="' . esc_url($phone_sv['cta_url']) . '"><span>' . $phone_sv['cta_text'] . '</span></a>';
											}
											?>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="bt-main-post-col">
						<div class="bt-post ">
							<div class="bt-post--thumbnail">
								<div class="bt-cover-image">
									<?php
									if (has_post_thumbnail()) {
										the_post_thumbnail('full');
									}
									?>
								</div>
							</div>

							<?php if (!empty($thumb)) { ?>
								<div class="bt-post--infor">
									<div class="bt-post--info">
										<img src="<?php echo esc_url($thumb); ?>" alt="<?php echo get_the_title($post_id); ?>">
									</div>
								</div>
							<?php } ?>
							<h2 class="bt-post--title"><?php the_title(); ?></h2>
							<div class="bt-post--content">
								<?php the_content(); ?>
							</div>
							<?php echo chambeshi_cta_free_consultation(); ?>
						</div>
					</div>


				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php
	if (!empty($id_elementor)) {
		foreach ($id_elementor as $key => $e) {
			$id_template = $e->ID;
			echo do_shortcode('[elementor-template id="' . $id_template . '"]');
		}
	}
	?>
</main><!-- #main -->

<?php get_footer(); ?>