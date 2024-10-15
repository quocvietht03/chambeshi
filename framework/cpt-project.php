<?php
/*
 * Project CPT
 */

function chambeshi_project_register() {

	$cpt_slug = get_theme_mod('chambeshi_project_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'project';
	}

	$labels = array(
		'name'               => esc_html__( 'Projects', 'chambeshi' ),
		'singular_name'      => esc_html__( 'Project', 'chambeshi' ),
		'add_new'            => esc_html__( 'Add New', 'chambeshi' ),
		'add_new_item'       => esc_html__( 'Add New Project', 'chambeshi' ),
		'all_items'          => esc_html__( 'All Projects', 'chambeshi' ),
		'edit_item'          => esc_html__( 'Edit Project', 'chambeshi' ),
		'new_item'           => esc_html__( 'Add New Project', 'chambeshi' ),
		'view_item'          => esc_html__( 'View Item', 'chambeshi' ),
		'search_items'       => esc_html__( 'Search Projects', 'chambeshi' ),
		'not_found'          => esc_html__( 'No project(s) found', 'chambeshi' ),
		'not_found_in_trash' => esc_html__( 'No project(s) found in trash', 'chambeshi' )
	);

  $args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
		'hierarchical'    => false,
		'has_archive'     => true,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'show_in_rest' 		=> true,
		'taxonomies'      => array('project_categories', 'project_tag'),
		'supports'        => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author')
  );

  add_filter( 'enter_title_here',  'chambeshi_project_change_default_title');

  register_post_type( 'project' , $args );
}
add_action('init', 'chambeshi_project_register', 1);


function chambeshi_project_taxonomy() {

	register_taxonomy(
		"project_categories",
		array("project"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			'show_in_rest' 		=> true,
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'project_tag',
        'project',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'chambeshi' ),
            'singular_name' => __( 'Tag', 'chambeshi' ),
			'show_in_rest' 		=> true,
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'chambeshi_project_taxonomy', 1);


function chambeshi_project_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'project' == $screen->post_type )
		$title = esc_html__( "Enter the project's name here", 'chambeshi' );

	return $title;
}


function chambeshi_project_edit_columns( $project_columns ) {
	$project_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'chambeshi'),
		"thumbnail"              => esc_html__('Thumbnail', 'chambeshi'),
		"project_categories" 			 => esc_html__('Categories', 'chambeshi'),
		"date"                   => esc_html__('Date', 'chambeshi'),
	);
	return $project_columns;
}
add_filter( 'manage_edit-project_columns', 'chambeshi_project_edit_columns' );

function chambeshi_project_column_display( $project_columns, $post_id ) {

	switch ( $project_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo wp_kses_post( $thumb ); 
			} else {
				echo esc_html__('None', 'chambeshi');
			}
			break;

		// Display the project tags in the column view
		case "project_categories":

		if ( $category_list = get_the_term_list( $post_id, 'project_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'chambeshi');
		}
		break;
	}
}
add_action( 'manage_project_posts_custom_column', 'chambeshi_project_column_display', 10, 2 );
