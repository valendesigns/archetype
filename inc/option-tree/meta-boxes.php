<?php
/**
 * Archetype OptionTree Meta Boxes
 *
 * @package Archetype
 * @subpackage Option_Tree
 * @since 1.0.0
 */

/**
 * Register Meta Boxes
 *
 * @uses ot_register_meta_box()
 *
 * @since 1.0.0
 */
function archetype_register_meta_boxes() {
	// OptionTree is not installed.
	if ( ! function_exists( 'ot_register_meta_box' ) ) {
		return false;
	}

	global $wp_post_types;

	$post_id   = isset( $_GET['post'] ) ? $_GET['post'] : ( isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : 0 );
	$post_data = get_post( $post_id, ARRAY_A );
	$post_name = isset( $post_data['post_name'] ) ? $post_data['post_name'] : '';
	$post_type = isset( $post_data['post_type'] ) ? $post_data['post_type'] : 'post';
	$is_post   = 'post' === $post_type;
	$fields    = array();
	$types     = array();

	// Additional hidden title text.
	$post_format_i18n = $is_post ? sprintf( __( 'Note: that this will not unhide titles for certain post formats. These are hidden with the %s filter.', 'archetype' ), '<code>archetype_hide_title_post_formats</code>' ) : '';

	// Hide titles.
	$fields[] = array(
		'label'       => __( 'Hide the Title.', 'archetype' ),
		'id'          => '_archetype_hide_title',
		'type'        => 'on-off',
		'desc'        => sprintf( __( 'Setting this to %s will hide the %s title. %s', 'archetype' ), '<code>on</code>', $post_type, $post_format_i18n ),
		'std'         => 'off',
	);

	// Hide bio.
	if ( in_array( $post_type, array( 'post' ) ) ) {
		$fields[] = array(
			'label'      => __( 'Hide the Author Bio.', 'archetype' ),
			'id'         => '_archetype_hide_author_bio',
			'type'       => 'on-off',
			'desc'       => sprintf( __( 'Setting this to %s will hide the author bio and post footer meta link.', 'archetype' ), '<code>on</code>' ),
			'std'        => 'off',
		);
	}

	// Post & page meta boxes.
	$meta_box = apply_filters( 'archetype_register_meta_boxes', array(
		'id'          => 'archetype_meta_box',
		'title'       => __( 'Archetype Meta', 'archetype' ),
		'desc'        => '',
		'pages'       => apply_filters( 'archetype_register_meta_boxes_pages', array( 'post', 'page' ) ),
		'context'     => 'normal',
		'priority'    => 'core',
		'fields'      => apply_filters( 'archetype_register_meta_boxes_fields', $fields ),
	) );

	// Register the meta boxes.
	ot_register_meta_box( $meta_box );

	// Reset the fields array.
	$fields = array();

	// LayerSlider.
	if ( class_exists( 'LS_Sliders', false ) ) {
		global $wpdb;
		$table = $wpdb->prefix.LS_DB_TABLE;
		$sliders = $wpdb->get_results( "SELECT id, name FROM $table WHERE flag_hidden = '0' AND flag_deleted = '0'", ARRAY_A );
		$choices = array(
			array(
				'value' => '',
				'label' => __( '-- Choose One --', 'archetype' ),
			),
		);

		foreach ( $sliders as $key => $item ) {
			$choices[] = array(
				'value' => $item['id'],
				'label' => $item['name'],
			);
		}

		if ( ! empty( $sliders ) ) {
			$fields[] = array(
				'label'      => __( 'LayerSlider', 'archetype' ),
				'id'         => '_archetype_layer_slider',
				'type'       => 'select',
				'desc'       => '',
				'std'        => '',
				'choices'    => $choices,
				'condition'  => '_archetype_slider:is(layer_slider)',
			);

			$types[] = array(
				'value' => 'layer_slider',
				'label' => __( 'LayerSlider', 'archetype' ),
			);
		}
	}

	// Revolution Slider.
	if ( class_exists( 'RevSlider', false ) ) {
		$theslider = new RevSlider();
		$sliders   = $theslider->getArrSliders();
		$choices = array(
			array(
				'value' => '',
				'label' => __( '-- Choose One --', 'archetype' ),
			),
		);

		if ( ! empty( $sliders ) ) {
			foreach ( $sliders as $slider ) {
				$choices[] = array(
					'value' => $slider->getAlias(),
					'label' => $slider->getTitle(),
				);
			}

			$fields[] = array(
				'label'      => __( 'Revolution Slider', 'archetype' ),
				'id'         => '_archetype_revolution_slider',
				'type'       => 'select',
				'desc'       => '',
				'std'        => '',
				'choices'    => $choices,
				'condition'  => '_archetype_slider:is(revolution_slider)',
			);

			$types[] = array(
				'value' => 'revolution_slider',
				'label' => __( 'Revolution Slider', 'archetype' ),
			);
		}
	}

	if ( ! empty( $fields ) ) {
		$types[] = array(
			'value' => '',
			'label' => __( 'None', 'archetype' ),
		);

		$fields[] = array(
			'label'      => __( 'Active Slider', 'archetype' ),
			'id'         => '_archetype_slider',
			'type'       => 'radio',
			'desc'       => '',
			'std'        => '',
			'choices'    => array_reverse( $types ),
		);
	}

	// Slider meta boxes.
	$meta_box = apply_filters( 'archetype_register_slider_meta_boxes', array(
		'id'          => 'archetype_slider_meta_box',
		'title'       => __( 'Slider Options', 'archetype' ),
		'desc'        => __( 'Archetype supports Revolution Slider, and LayerSlider. Support for additional slider plugins will be added on request.', 'archetype' ),
		'pages'       => apply_filters( 'archetype_register_slider_meta_boxes_pages', array( 'post', 'page', 'project', 'product' ) ),
		'context'     => 'normal',
		'priority'    => 'core',
		'fields'      => apply_filters( 'archetype_register_slider_meta_boxes_fields', array_reverse( $fields ) ),
	) );

	// Register the meta boxes.
	ot_register_meta_box( $meta_box );

}
