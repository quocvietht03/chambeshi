<?php
/**
 * Import pack hooks
 *
 * @package Import Pack
 */

add_action( 'admin_init', 'chambeshi_import_pack_defineds' );
add_action( 'admin_menu', 'chambeshi_register_import_menu' );
