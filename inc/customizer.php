<?php
/**
 * MaudTheme Theme Customizer
 *
 * @package MaudTheme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function maudtheme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'maudtheme_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'maudtheme_customize_partial_blogdescription',
		) );
	}
	//=============================================================
	// Remove Colors, Background image, and Static front page
	// option from theme customizer
	//=============================================================
	$wp_customize->remove_section("colors");
	$wp_customize->remove_section("background_image");
	$wp_customize->remove_section("static_front_page");
	$wp_customize->remove_section("custom_css");
	$wp_customize->remove_section("header_image");

	//=============================================================
	// Header Theme information
	//=============================================================
	// Ajout d'une section pour le Header
	$wp_customize->add_section(
	'header_section',
	array(
	'title' => "Informations d'entête",
	'description' => 'Personnalisez ici le Header de votre site',
	'priority' => 35,
	)
	);
	// ajout d'un réglage pour le logo
	$wp_customize->add_setting('header_logo');

	// ajout d'un contrôle d'upload de Logo
	$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'header_logo',
			array(
			'label' => 'Upload de logo',
			'section' => 'header_section',
			'settings' => 'header_logo'
			)
		)
	);

	$wp_customize->add_setting('address', array(
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		'address',
		array(
			'label' => 'Adresse',
			'sanitize_callback' => 'example_sanitize_text',
			'section' => 'header_section',
			'settings' => 'address',
			'type' => 'textarea'
		)
	);

	$wp_customize->add_setting('phone');
	$wp_customize->add_control(
		'phone',
		array(
			'label' => 'Téléphone',
			'section' => 'header_section',
			'settings' => 'phone',
			'type' => 'tel'
		)
	);
	$wp_customize->add_setting('email');
	$wp_customize->add_control(
		'email',
		array(
			'label' => 'Email',
			'section' => 'header_section',
			'settings' => 'email',
			'type' => 'email'
		)
	);


	//=============================================================
	// Footer Theme information
	//=============================================================
	// Ajout d'une section pour le Header
	$wp_customize->add_section(
	'footer_section',
	array(
	'title' => 'Informations de pied de page',
	'description' => 'Personnalisez ici le Footer de votre site',
	'priority' => 40,
	)
	);
	// ajout d'un réglage pour le logo
	$wp_customize->add_setting('footer_logo');

	// ajout d'un contrôle d'upload de Logo
	$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'footer_logo',
			array(
			'label' => 'Upload de logo',
			'section' => 'footer_section',
			'settings' => 'footer_logo'
			)
		)
	);

	$wp_customize->add_setting('footer_titre');
	$wp_customize->add_control(
		'footer_titre',
		array(
			'label' => 'Titre du footer',
			'section' => 'footer_section',
			'settings' => 'footer_titre',
			'type' => 'text'
		)
	);
	$wp_customize->add_setting('footer_sstitre', array(
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control(
		'footer_sstitre',
		array(
			'label' => 'Description du footer',
			'sanitize_callback' => 'example_sanitize_text',
			'section' => 'footer_section',
			'settings' => 'footer_sstitre',
			'type' => 'textarea'
		)
	);



}
add_action( 'customize_register', 'maudtheme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function maudtheme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function maudtheme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function maudtheme_customize_preview_js() {
	wp_enqueue_script( 'maudtheme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'maudtheme_customize_preview_js' );
