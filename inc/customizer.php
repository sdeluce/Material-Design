<?php
/**
 * Material Design Theme Customizer
 *
 * @package Material Design
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function materialdesign_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->add_setting('materialdesign_primary', array(
		'default'        => '#03a9f4',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
	));

	$wp_customize->add_control('materialdesign_primary_color', array(
		'label'      => __('Primary color', 'materialdesign'),
		'section'    => 'colors',
		'settings'   => 'materialdesign_primary',
		'type'    => 'color',
	));

	$wp_customize->add_setting('materialdesign_secondary', array(
		'default'        => '#ffca28',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
	));

	$wp_customize->add_control('materialdesign_secondary_color', array(
		'label'      => __('Secondary color', 'materialdesign'),
		'section'    => 'colors',
		'settings'   => 'materialdesign_secondary',
		'type'    => 'color',
	));

	$wp_customize->add_section( 'materialdesign_reading_time' , array(
		'title'      => __( 'Reading time', 'materialdesign' ),
		'priority'   => 28,
	));

	$wp_customize->add_setting('materialdesign_reading_word_per_min', array(
		'default'        => '200',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	));

	$wp_customize->add_control('materialdesign_wpm', array(
		'label'      => __('Words per minutes', 'materialdesign'),
		'section'    => 'materialdesign_reading_time',
		'settings'   => 'materialdesign_reading_word_per_min',
	));

	$wp_customize->add_setting('materialdesign_reading_format', array(
		'default'        => 'min',
		'capability'     => 'edit_theme_options',
		'type'           => 'option',
	));
	
	$wp_customize->add_control( 'example_select_box', array(
		'label'   => __('Select the format', 'materialdesign'),
		'section' => 'materialdesign_reading_time',
		'settings' => 'materialdesign_reading_format',
		'type'    => 'select',
		'choices'    => array(
			'min' => __('xx min', 'materialdesign'),
			'sec' => __('x:xx sec', 'materialdesign'),
		),
	));

	//var_dump($wp_customize);
}
add_action( 'customize_register', 'materialdesign_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function materialdesign_customize_preview_js() {
	wp_enqueue_script( 'materialdesign_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'materialdesign_customize_preview_js' );
