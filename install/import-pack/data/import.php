<?php
/**
 * Import pack data package demo
 *
 */
$plugin_includes = array(
  array(
    'name'     => __( 'Elementor Website Builder', 'chambeshi' ),
    'slug'     => 'elementor',
  ),
  array(
    'name'     => __( 'Elementor Pro', 'chambeshi' ),
    'slug'     => 'elementor-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'elementor-pro.zip',
  ),
  array(
    'name'     => __( 'Smart Slider 3 Pro', 'chambeshi' ),
    'slug'     => 'nextend-smart-slider3-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'nextend-smart-slider3-pro.zip',
  ),
  array(
    'name'     => __( 'Advanced Custom Fields PRO', 'chambeshi' ),
    'slug'     => 'advanced-custom-fields-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'advanced-custom-fields-pro.zip',
  ),
  array(
    'name'     => __( 'Gravity Forms', 'chambeshi' ),
    'slug'     => 'gravityforms',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'gravityforms.zip',
  ),
  array(
    'name'     => __( 'Newsletter', 'chambeshi' ),
    'slug'     => 'newsletter',
  ),
  array(
    'name'     => __( 'WooCommerce', 'chambeshi' ),
    'slug'     => 'woocommerce',
  ),

);

return apply_filters( 'chambeshi/import_pack/package_demo', [
    [
        'package_name' => 'chambeshi-main',
        'preview' => get_template_directory_uri() . '/screenshot.jpg',
        'url_demo' => 'https://chambeshi.beplusthemes.com/',
        'title' => __( 'Chambeshi Demo', 'chambeshi' ),
        'description' => __( 'Chambeshi main demo.', 'chambeshi' ),
        'plugins' => $plugin_includes,
    ],
] );
