Below is a **Markdown-formatted instruction manual** you can give to an AI (or a developer) to generate a zero-touch WordPress plugin that injects your GTM snippet into every page. It omits any Facebook Pixel fallback—only the GTM code is included.

---

## Smart Audience Engine™ GTM Plugin — Instruction Manual

### 1. Plugin Overview

* **Name**: `smart-audience-engine`
* **Purpose**: Automatically inject a pre-configured GTM container into the `<head>` and `<body>` of every page.
* **Installation**: Download, install, and activate—no settings or UI needed.

---

### 2. Folder & File Structure

```
smart-audience-engine/
├── smart-audience-engine.php
└── readme.txt           # (optional) plugin description
```

---

### 3. `smart-audience-engine.php` Boilerplate

```php
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
```

---

### 4. Hooking GTM into `<head>`

1. **Action**: `wp_head`
2. **Priority**: `1` (as early as possible)
3. **Function**: `sae_insert_gtm_head()`

```php
add_action( 'wp_head', 'sae_insert_gtm_head', 1 );
function sae_insert_gtm_head() {
    ?>
    <!-- Google Tag Manager -->
    <script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-P6LVXLBZ');
    </script>
    <!-- End Google Tag Manager -->
    <?php
}
```

> **Note**: Replace `GTM-P6LVXLBZ` with your actual GTM Container ID.

---

### 5. Hooking GTM `<noscript>` into `<body>`

1. **Action**: `wp_body_open` (for themes supporting it)

   * If the theme lacks `wp_body_open`, fallback to `wp_footer` at priority `0`.

```php
add_action( 'wp_body_open', 'sae_insert_gtm_body', 1 );
function sae_insert_gtm_body() {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P6LVXLBZ"
              height="0" width="0" style="display:none;visibility:hidden">
      </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
```

> **Fallback** (if no `wp_body_open`):
>
> ```php
> add_action( 'wp_footer', 'sae_insert_gtm_body', 0 );
> ```

---

### 6. Packaging & Distribution

1. **Zip** the `smart-audience-engine/` folder.
2. Provide to clients to install via **WordPress → Plugins → Upload Plugin**.
3. Activate—**no configuration panel**, tracking is live immediately.

---

### 7. Testing & Verification

1. Install plugin on a staging site.
2. View source of any page; confirm the `<script>` appears in `<head>` and the `<noscript>` iframe appears immediately after `<body>`.
3. Use **Tag Assistant** (Chrome extension) to verify your GTM container is firing.

---

### 8. (Optional) Future Enhancements

* Add version check and auto-update hooks.
* Integrate Admin Notices if GTM ID is missing or invalid.
* Support alternative CMS by abstracting the injection points.

---

**End of Manual**
Use this spec to auto-generate or hand-code your “Smart Audience Engine” GTM plugin for instant, foolproof container deployment.
