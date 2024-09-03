<?php
/*
 * Company CPT
 */

function chambeshi_company_register() {

	$cpt_slug = get_theme_mod('chambeshi_company_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'company';
	}

	$labels = array(
		'name'               => esc_html__( 'Company', 'chambeshi' ),
		'singular_name'      => esc_html__( 'Company', 'chambeshi' ),
		'add_new'            => esc_html__( 'Add New', 'chambeshi' ),
		'add_new_item'       => esc_html__( 'Add New Company', 'chambeshi' ),
		'all_items'          => esc_html__( 'All Company', 'chambeshi' ),
		'edit_item'          => esc_html__( 'Edit Company', 'chambeshi' ),
		'new_item'           => esc_html__( 'Add New Company', 'chambeshi' ),
		'view_item'          => esc_html__( 'View Item', 'chambeshi' ),
		'search_items'       => esc_html__( 'Search Company', 'chambeshi' ),
		'not_found'          => esc_html__( 'No company(s) found', 'chambeshi' ),
		'not_found_in_trash' => esc_html__( 'No company(s) found in trash', 'chambeshi' )
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

  add_filter( 'enter_title_here',  'chambeshi_company_change_default_title');

  register_post_type( 'company' , $args );
}
add_action('init', 'chambeshi_company_register', 1);


function chambeshi_company_taxonomy() {

	register_taxonomy(
		"company_categories",
		array("company"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'company_tag',
        'company',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'chambeshi' ),
            'singular_name' => __( 'Tag', 'chambeshi' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'chambeshi_company_taxonomy', 1);


function chambeshi_company_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'company' == $screen->post_type )
		$title = esc_html__( "Enter the company's name here", 'chambeshi' );

	return $title;
}


function chambeshi_company_edit_columns( $company_columns ) {
	$company_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'chambeshi'),
		"thumbnail"              => esc_html__('Thumbnail', 'chambeshi'),
		"company_categories" 			 => esc_html__('Categories', 'chambeshi'),
		"date"                   => esc_html__('Date', 'chambeshi'),
	);
	return $company_columns;
}
add_filter( 'manage_edit-company_columns', 'chambeshi_company_edit_columns' );

function chambeshi_company_column_display( $company_columns, $post_id ) {

	switch ( $company_columns ) {

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

		// Display the company tags in the column view
		case "company_categories":

		if ( $category_list = get_the_term_list( $post_id, 'company_categories', '', ', ', '' ) ) {
			echo wp_kses_post( $category_list );
		} else {
			echo esc_html__('None', 'chambeshi');
		}
		break;
	}
}
add_action( 'manage_company_posts_custom_column', 'chambeshi_company_column_display', 10, 2 );
