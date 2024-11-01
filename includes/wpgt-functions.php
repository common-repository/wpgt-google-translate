<?php
/**
 * Functions.
 *
 * @package WPGT/Functions
 */

/**
 * Display language selection dropdown on front end
 *
 * @param string $type Type of Call.
 * @since 1.0
 */
function wpgt_language_field( $type ) {

	wp_enqueue_script(
		'wpgt-google-translate',
		plugins_url() . '/wpgt-google-translate/assets/js/wpgt-google-translate.js',
		array( 'jquery' ),
		WPGT_VERSION,
		true
	);

	wp_localize_script(
		'wpgt-google-translate',
		'wpgt_google_translate_params',
		array( 'locale' => get_locale() )
	);

	wp_enqueue_script(
		'wpgt-google-translate-element',
		'//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit',
		array(),
		WPGT_VERSION,
		true
	);

	// {pageLanguage: 'en', includedLanguages: 'xx,xx,xx,xx', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}
	// with flag. https://stackoverflow.com/questions/10486833/implementing-google-translate-with-custom-flag-icons
	if ( 'widget' === $type ) {
		?>
			<div id="google_translate_element"></div>
			<style type="text/css">
				.goog-logo-link{
					display: none;
				}
			</style>
		<?php
	} else {
		return '<div id="google_translate_element"></div>
		<style type="text/css">
			.goog-logo-link{
				display: none;
			}
		</style>';
	}
}
