jQuery( window ).load( function () {
    jQuery( ".goog-logo-link" ).parent().remove();
    jQuery( ".goog-te-combo" ).css( "width", "100%" );
    jQuery( ".goog-te-combo" ).css( "padding", "5" );
});

function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: wpgt_google_translate_params.locale}, 'google_translate_element');
}