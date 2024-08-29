<?php
/*
 * Gallery CPT
 */

function chambeshi_gallery_register()
{

	$cpt_slug = get_theme_mod('chambeshi_gallery_slug');

	if (isset($cpt_slug) && $cpt_slug != '') {
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'gallery';
	}

	$labels = array(
		'name'               => esc_html__('Gallery', 'chambeshi'),
		'singular_name'      => esc_html__('Gallery', 'chambeshi'),
		'add_new'            => esc_html__('Add New', 'chambeshi'),
		'add_new_item'       => esc_html__('Add New Gallery', 'chambeshi'),
		'all_items'          => esc_html__('All Gallery', 'chambeshi'),
		'edit_item'          => esc_html__('Edit Gallery', 'chambeshi'),
		'new_item'           => esc_html__('Add New Gallery', 'chambeshi'),
		'view_item'          => esc_html__('View Item', 'chambeshi'),
		'search_items'       => esc_html__('Search Gallery', 'chambeshi'),
		'not_found'          => esc_html__('No gallery(s) found', 'chambeshi'),
		'not_found_in_trash' => esc_html__('No gallery(s) found in trash', 'chambeshi')
	);

	$args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'publicly_queryable' => false,
		'hierarchical'    => false,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'supports'        => array('title', 'thumbnail')
	);

	add_filter('enter_title_here',  'chambeshi_gallery_change_default_title');

	register_post_type('gallery', $args);
}
add_action('init', 'chambeshi_gallery_register', 1);


function chambeshi_gallery_taxonomy()
{

	register_taxonomy(
		"gallery_categories",
		array("gallery"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
		'gallery_tag',
		'gallery',
		array(
			'hierarchical'  => false,
			'label'         => __('Tags', 'chambeshi'),
			'singular_name' => __('Tag', 'chambeshi'),
			'rewrite'       => true,
			'query_var'     => true
		)
	);
}
add_action('init', 'chambeshi_gallery_taxonomy', 1);


function chambeshi_gallery_change_default_title($title)
{
	$screen = get_current_screen();

	if ('gallery' == $screen->post_type)
		$title = esc_html__("Enter the gallery's name here", 'chambeshi');

	return $title;
}


function chambeshi_gallery_edit_columns($gallery_columns)
{
	$gallery_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'chambeshi'),
		"thumbnail"              => esc_html__('Thumbnail', 'chambeshi'),
		"gallery_categories" 			 => esc_html__('Categories', 'chambeshi'),
		"date"                   => esc_html__('Date', 'chambeshi'),
	);
	return $gallery_columns;
}
add_filter('manage_edit-gallery_columns', 'chambeshi_gallery_edit_columns');

function chambeshi_gallery_column_display($gallery_columns, $post_id)
{

	switch ($gallery_columns) {

			// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);

			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image($thumbnail_id, array($width, $height), true);
			}
			if (isset($thumb)) {
				echo wp_kses_post( $thumb ); 
			} else {
				echo esc_html__('None', 'chambeshi');
			}
			break;

			// Display the gallery tags in the column view
		case "gallery_categories":

			if ($category_list = get_the_term_list($post_id, 'gallery_categories', '', ', ', '')) {
				echo wp_kses_post( $category_list );
			} else {
				echo esc_html__('None', 'chambeshi');
			}
			break;
	}
}
add_action('manage_gallery_posts_custom_column', 'chambeshi_gallery_column_display', 10, 2);
