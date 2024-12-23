<?php
if (! isset($content_width)) $content_width = 900;
if (is_singular()) wp_enqueue_script("comment-reply");

if (! function_exists('chambeshi_setup')) {
	function chambeshi_setup()
	{
		/* Load textdomain */
		load_theme_textdomain('chambeshi', get_template_directory() . '/languages');

		/* Add custom logo */
		add_theme_support('custom-logo');

		/* Add RSS feed links to <head> for posts and comments. */
		add_theme_support('automatic-feed-links');

		/* Enable support for Post Thumbnails, and declare sizes. */
		add_theme_support('post-thumbnails');

		/* Enable support for Title Tag */
		add_theme_support("title-tag");

		/* This theme uses wp_nav_menu() in locations. */
		register_nav_menus(array(
			'primary_menu'   => esc_html__('Primary Menu', 'chambeshi'),

		));

		/* This theme styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width. */
		add_editor_style('editor-style.css');

		/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		));

		add_theme_support('wp-block-styles');
		add_theme_support('responsive-embeds');
		add_theme_support('custom-header');
		add_theme_support('align-wide');

		/* This theme allows users to set a custom background. */
		add_theme_support('custom-background', apply_filters('chambeshi_custom_background_args', array(
			'default-color' => 'f5f5f5',
		)));

		/* Add support for featured content. */
		add_theme_support('featured-content', array(
			'featured_content_filter' => 'chambeshi_get_featured_posts',
			'max_posts' => 6,
		));

		/* This theme uses its own gallery styles. */
		add_filter('use_default_gallery_style', '__return_false');

		/* Add support woocommerce */
		add_theme_support('woocommerce');
	}
}
add_action('after_setup_theme', 'chambeshi_setup');

/* Custom Site Title */
if (! function_exists('chambeshi_wp_title')) {
	function chambeshi_wp_title($title, $sep)
	{
		global $paged, $page;
		if (is_feed()) {
			return $title;
		}
		// Add the site name.
		$title .= get_bloginfo('name');
		// Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');
		if ($site_description && (is_home() || is_front_page())) {
			$title = "$title $sep $site_description";
		}
		// Add a page number if necessary.
		if ($paged >= 2 || $page >= 2) {
			$title = sprintf(esc_html__('Page %s', 'chambeshi'), max($paged, $page)) . " $sep $title";
		}
		return $title;
	}
	add_filter('wp_title', 'chambeshi_wp_title', 10, 2);
}

/* Logo */
if (!function_exists('chambeshi_logo')) {
	function chambeshi_logo($url = '', $height = 30)
	{
		if (!$url) {
			$url = get_template_directory_uri() . '/assets/images/site-logo.png';
		}
		echo '<a href="' . home_url('/') . '"><img class="logo" style="height: ' . esc_attr($height) . 'px; width: auto;" src="' . esc_url($url) . '" alt="' . esc_attr__('Logo', 'chambeshi') . '"/></a>';
	}
}

/* Nav Menu */
if (!function_exists('chambeshi_nav_menu')) {
	function chambeshi_nav_menu($menu_slug = '', $theme_location = '', $container_class = '')
	{
		if (has_nav_menu($theme_location) || $menu_slug) {
			wp_nav_menu(array(
				'menu'				=> $menu_slug,
				'container_class' 	=> $container_class,
				'items_wrap'      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'theme_location'  	=> $theme_location
			));
		} else {
			wp_page_menu(array(
				'menu_class'  => $container_class
			));
		}
	}
}
/* Page title */
if (!function_exists('chambeshi_page_title')) {
	function chambeshi_page_title()
	{
		ob_start();
		if (is_front_page()) {
			esc_html_e('Home', 'chambeshi');
		} elseif (is_home()) {
			esc_html_e('Blog', 'chambeshi');
		} elseif (is_search()) {
			esc_html_e('Search', 'chambeshi');
		} elseif (is_404()) {
			esc_html_e('404', 'chambeshi');
		} elseif (is_page()) {
			echo get_the_title();
		} elseif (is_archive()) {
			if (is_category()) {
				single_cat_title();
			} elseif (get_post_type() == 'service' || get_post_type() == 'project') {
				if (!is_tax()) {
					echo post_type_archive_title();
				 }else{
					single_cat_title();
				 }
			} elseif (get_post_type() == 'product') {
				if (wc_get_page_id('shop')) {
					echo get_the_title(wc_get_page_id('shop'));
				} else {
					single_term_title();
				}
			} elseif (is_tag()) {
				single_tag_title();
			} elseif (is_author()) {
				printf(__('Author: %s', 'chambeshi'), '<span class="vcard">' . get_the_author() . '</span>');
			} elseif (is_day()) {
				printf(__('Day: %s', 'chambeshi'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_month()) {
				printf(__('Month: %s', 'chambeshi'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_year()) {
				printf(__('Year: %s', 'chambeshi'), '<span>' . get_the_date(get_option('date_format')) . '</span>');
			} elseif (is_tax('post_format', 'post-format-aside')) {
				esc_html_e('Aside', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-gallery')) {
				esc_html_e('Gallery', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-image')) {
				esc_html_e('Image', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-video')) {
				esc_html_e('Video', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-quote')) {
				esc_html_e('Quote', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-link')) {
				esc_html_e('Link', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-status')) {
				esc_html_e('Status', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-audio')) {
				esc_html_e('Audio', 'chambeshi');
			} elseif (is_tax('post_format', 'post-format-chat')) {
				esc_html_e('Chat', 'chambeshi');
			} else {
				esc_html_e('Archive', 'chambeshi');
			}
		} else {
			echo get_the_title();
		}

		return ob_get_clean();
	}
}

/* Page breadcrumb */
if (!function_exists('chambeshi_page_breadcrumb')) {
	function chambeshi_page_breadcrumb($home_text = 'Home', $delimiter = '-')
	{
		global $post;

		if (is_front_page()) {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Front Page', 'chambeshi');
		} elseif (is_home()) {
			echo  '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ' . esc_html('Blog', 'chambeshi');
		} else {
			echo '<a class="bt-home" href="' . esc_url(home_url('/')) . '">' . $home_text . '</a> <span class="bt-deli first">' . $delimiter . '</span> ';
		}

		if (is_category()) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' <span class="bt-deli">' . $delimiter . '</span> ');
			echo '<span class="current">' . single_cat_title(esc_html__('Archive by category: ', 'chambeshi'), false) . '</span>';
		} elseif (is_tag()) {
			echo '<span class="current">' . single_tag_title(esc_html__('Posts tagged: ', 'chambeshi'), false) . '</span>';
		} elseif (is_post_type_archive()) {
			echo '<span class="current">' . post_type_archive_title(esc_html__('Archive: ', 'chambeshi'), false) . '</span>';
		} elseif (is_tax()) {
			echo '<span class="current">' . single_term_title(esc_html__('Archive by taxonomy: ', 'chambeshi'), false) . '</span>';
		} elseif (is_search()) {
			echo '<span class="current">' . esc_html__('Search results for: ', 'chambeshi') . get_search_query() . '</span>';
		} elseif (is_day()) {
			echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . ' ' . get_the_time('Y') . '</a> <span class="bt-deli">' . $delimiter . '</span> ';
			echo '<span class="current">' . get_the_time('d') . '</span>';
		} elseif (is_month()) {
			echo '<span class="current">' . get_the_time('F') . ' ' . get_the_time('Y') . '</span>';
		} elseif (is_single() && !is_attachment()) {
			if (get_post_type() != 'post') {
				if (get_post_type() == 'product') {
					$terms = get_the_terms(get_the_ID(), 'product_cat', '', '');
					if (!empty($terms) && !is_wp_error($terms)) {
						the_terms(get_the_ID(), 'product_cat', '', ', ');
						echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
					} else {
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				} else {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					if ($post_type->rewrite) {
						echo '<a href="' . esc_url(home_url('/')) . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
					}
					if (!in_array(get_post_type(), ['team', 'service', 'project'])) {
						echo '<span class="current">' . get_the_title() . '</span>';
					}
				}
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, '');
				echo '' . $cats;
			}
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if ($post_type) echo '<span class="current">' . $post_type->labels->name . '</span>';
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && !$post->post_parent) {
			echo '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_page() && !is_front_page() && $post->post_parent) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo '' . $breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' <span class="bt-deli">' . $delimiter . '</span> ';
			}
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif (is_author()) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html__('Articles posted by ', 'chambeshi') . $userdata->display_name . '</span>';
		} elseif (is_404()) {
			echo '<span class="current">' . esc_html__('404 Error', 'chambeshi') . '</span>';
		}

		if (get_query_var('paged')) {
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
			echo ' <span class="bt-deli">' . $delimiter . '</span> ' . esc_html__('Page', 'chambeshi') . ' ' . get_query_var('paged');
			if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
		}
	}
}

/* Display navigation to next/previous post */
if (! function_exists('chambeshi_post_nav')) {
	function chambeshi_post_nav()
	{
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next     = get_adjacent_post(false, '', false);
		if (! $next && ! $previous) {
			return;
		}
?>
		<nav class="bt-post-nav clearfix">
			<?php
			previous_post_link('<div class="bt-post-nav--item bt-prev"><span>' . esc_html__('Previous Post', 'chambeshi') . '</span><h3>%link</h3></div>');
			next_post_link('<div class="bt-post-nav--item bt-next"><span>' . esc_html__('Next Post', 'chambeshi') . '</span><h3>%link</h3></div>');
			?>
		</nav>
	<?php
	}
}

/* Display paginate links */
if (! function_exists('chambeshi_paginate_links')) {
	function chambeshi_paginate_links($wp_query)
	{
		if ($wp_query->max_num_pages <= 1) {
			return;
		}
	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			$big = 999999999; // need an unlikely integer
			echo paginate_links(array(
				'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $wp_query->max_num_pages,
				'prev_text' => '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"/>
													</svg> ' . esc_html__('Prev', 'chambeshi'),
				'next_text' => esc_html__('Next', 'chambeshi') . '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"/>
												</svg>',
			));
			?>
		</nav>
	<?php
	}
}

/* Display navigation to next/previous set of posts */
if (! function_exists('chambeshi_paging_nav')) {
	function chambeshi_paging_nav()
	{
		if ($GLOBALS['wp_query']->max_num_pages < 2) {
			return;
		}

		$paged        = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
		$pagenum_link = html_entity_decode(get_pagenum_link());
		$query_args   = array();
		$url_parts    = explode('?', $pagenum_link);

		if (isset($url_parts[1])) {
			wp_parse_str($url_parts[1], $query_args);
		}

		$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
		$pagenum_link = trailingslashit($pagenum_link) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	?>
		<nav class="bt-pagination" role="navigation">
			<?php
			echo paginate_links(array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map('urlencode', $query_args),
				'prev_text' => '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
														<path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"/>
													</svg> ' . esc_html__('Prev', 'chambeshi'),
				'next_text' => esc_html__('Next', 'chambeshi') . '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
													<path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"/>
												</svg>',
			));
			?>
		</nav>
<?php
	}
}
