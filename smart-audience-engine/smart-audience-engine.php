<?php
/**
 * Plugin Name: Smart Audience Engine
 * Description: Automatically adds your GTM container to every page. Zero setup required.
 * Version:     1.0.0
 * Author:      Your Agency Name
 * Text Domain: smart-audience-engine
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Set the GTM container ID via constant or filter.
 * Define `SAE_GTM_ID` in `wp-config.php` or use the `sae_gtm_id` filter to override.
 * When printing the ID, always escape it (e.g., with `esc_attr()`).
 */
if ( ! defined( 'SAE_GTM_ID' ) ) {
    define( 'SAE_GTM_ID', 'GTM-TQR9W2M2' );
}

add_action( 'wp_head', 'sae_insert_gtm_head', 1 );
function sae_insert_gtm_head() {
    $gtm_id = esc_attr( apply_filters( 'sae_gtm_id', SAE_GTM_ID ) );
    ?>
    <!-- Google Tag Manager -->
    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo $gtm_id; ?>');
    </script>
    <!-- End Google Tag Manager -->
    <?php
}

if ( function_exists( 'wp_body_open' ) ) {
    add_action( 'wp_body_open', 'sae_insert_gtm_body', 1 );
} else {
    add_action( 'wp_footer', 'sae_insert_gtm_body', 0 ); // Fallback for older themes
}
function sae_insert_gtm_body() {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( apply_filters( 'sae_gtm_id', SAE_GTM_ID ) ); ?>"
              height="0" width="0" style="display:none;visibility:hidden">
      </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
