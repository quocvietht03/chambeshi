<?php
/*
 * Team CPT
 */

function chambeshi_team_register() {

	$cpt_slug = get_theme_mod('chambeshi_team_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'team';
	}

	$labels = array(
		'name'               => esc_html__( 'Teams', 'chambeshi' ),
		'singular_name'      => esc_html__( 'Team', 'chambeshi' ),
		'add_new'            => esc_html__( 'Add New', 'chambeshi' ),
		'add_new_item'       => esc_html__( 'Add New Team', 'chambeshi' ),
		'all_items'          => esc_html__( 'All Team', 'chambeshi' ),
		'edit_item'          => esc_html__( 'Edit Team', 'chambeshi' ),
		'new_item'           => esc_html__( 'Add New Team', 'chambeshi' ),
		'view_item'          => esc_html__( 'View Item', 'chambeshi' ),
		'search_items'       => esc_html__( 'Search Team', 'chambeshi' ),
		'not_found'          => esc_html__( 'No team(s) found', 'chambeshi' ),
		'not_found_in_trash' => esc_html__( 'No team(s) found in trash', 'chambeshi' )
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
		'supports'        => array('title', 'editor', 'thumbnail', 'comments')
  );

  add_filter( 'enter_title_here',  'chambeshi_team_change_default_title');

  register_post_type( 'team' , $args );
}
add_action('init', 'chambeshi_team_register', 1);


function chambeshi_team_taxonomy() {

	register_taxonomy(
		"team_categories",
		array("team"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'team_tag',
        'team',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'chambeshi' ),
            'singular_name' => __( 'Tag', 'chambeshi' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'chambeshi_team_taxonomy', 1);


function chambeshi_team_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'team' == $screen->post_type )
		$title = esc_html__( "Enter the team's name here", 'chambeshi' );

	return $title;
}


function chambeshi_team_edit_columns( $team_columns ) {
	$team_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'chambeshi'),
		"thumbnail"              => esc_html__('Thumbnail', 'chambeshi'),
		"team_categories" 			 => esc_html__('Categories', 'chambeshi'),
		"date"                   => esc_html__('Date', 'chambeshi'),
	);
	return $team_columns;
}
add_filter( 'manage_edit-team_columns', 'chambeshi_team_edit_columns' );

function chambeshi_team_column_display( $team_columns, $post_id ) {

	switch ( $team_columns ) {

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

		// Display the team tags in the column view
		case "team_categories":

		if ( $category_list = get_the_term_list( $post_id, 'team_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'chambeshi');
		}
		break;
	}
}
add_action( 'manage_team_posts_custom_column', 'chambeshi_team_column_display', 10, 2 );
