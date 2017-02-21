<?php
/**
 * Custom Post Type functionality
 *
 * @package     KnowTheCode\InsOutsPHPNamespacing\Custom
 * @since       1.0.0
 * @author      hellofromTonya
 * @link        https://knowthecode.io
 * @license     GNU General Public License 2.0+
 */

add_action( 'init', 'phpnamespacing_register_custom_post_type' );
/**
 * Register the custom post type.
 *
 * @since 1.0.0
 *
 * @return void
 */
function phpnamespacing_register_custom_post_type() {

	$labels = array(
		'name'               => _x( 'Journals', 'post type general name', 'php-namspacing' ),
		'singular_name'      => _x( 'Journal', 'post type singular name', 'php-namspacing' ),
		'menu_name'          => _x( 'Journals', 'admin menu', 'php-namspacing' ),
		'name_admin_bar'     => _x( 'Journal', 'add new on admin bar', 'php-namspacing' ),
		'add_new'            => _x( 'Add New Journal', 'team-bios', 'php-namspacing' ),
		'add_new_item'       => __( 'Add New Journal', 'php-namspacing' ),
		'new_item'           => __( 'New Journal', 'php-namspacing' ),
		'edit_item'          => __( 'Edit Journal', 'php-namspacing' ),
		'view_item'          => __( 'View Journal', 'php-namspacing' ),
		'all_items'          => __( 'All Journals', 'php-namspacing' ),
		'search_items'       => __( 'Search Journals', 'php-namspacing' ),
		'parent_item_colon'  => __( 'Parent Journals:', 'php-namspacing' ),
		'not_found'          => __( 'No journals found.', 'php-namspacing' ),
		'not_found_in_trash' => __( 'No journals found in Trash.', 'php-namspacing' ),
	);

	$features = phpnamespacing_get_all_post_type_features( 'post', array(
		'excerpt',
		'comments',
		'trackbacks',
		'custom-fields',
	) );

	$args = array(
		'label'        => __( 'Journals', 'php-namspacing' ),
		'labels'       => $labels,
		'public'       => true,
		'supports'     => $features,
		'menu_icon'    => 'dashicons-admin-page',
		'hierarchical' => false,
		'has_archive'  => true,
		'menu_position' => 10,
	);

	register_post_type( 'journal', $args );
}

/**
 * Get all the post type features for the given post type.
 *
 * @since 1.0.0
 *
 * @param string $post_type Given post type
 * @param array $exclude_features Array of features to exclude
 *
 * @return array
 */
function phpnamespacing_get_all_post_type_features( $post_type = 'post', $exclude_features = array() ) {
	$configured_features = get_all_post_type_supports( $post_type );

	if ( ! $exclude_features ) {
		return array_keys( $configured_features );
	}

	$features = array();

	foreach ( $configured_features as $feature => $value ) {
		if ( in_array( $feature, $exclude_features ) ) {
			continue;
		}

		$features[] = $feature;
	}

	return $features;
}
