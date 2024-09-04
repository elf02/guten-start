# Guten Start

A starter block theme. Have a "guten" start!

<br>

This is an extended fork from the [Powder Zero](https://github.com/bgardner/powder-zero) WordPress Theme, (C) 2022-2024 Brian Gardner.

Additionally, parts were borrowed from the [x3p0-ideas](https://github.com/x3p0-dev/x3p0-ideas/tree/block-example) Theme by Justin Tadlock.


## Requirements

- WordPress 6.6+
- PHP 8.0+
- License: [GNU General Public License v3](https://www.gnu.org/licenses/gpl-3.0.html)

## Getting Started

1. Ensure you are using WordPress 6.6+ and PHP 8.0+
3. Clone / download this repository into the `/wp-content/themes/` directory of your new WordPress instance.
4. Run the following commands from the theme root to install Composer and NPM packages:
```bash
composer install
npm install
```
For development you may add the following lines in your wp-config.php
```php
define( 'WP_ENVIRONMENT_TYPE', 'local' );
define( 'WP_DEVELOPMENT_MODE', 'theme' );
```
5. In the WordPress admin, use the Appearance > Themes screen to activate Guten Start.

## Recommended Plugins

- [Create Block Theme](https://wordpress.org/plugins/create-block-theme/)

- [Query Monitor](https://wordpress.org/plugins/query-monitor/)

- [Pattern Editor](https://wordpress.org/plugins/pattern-editor/) / [Pattern Manager](https://wordpress.org/plugins/pattern-manager/)

- [Classic Menu in Navigation Block](https://wordpress.org/plugins/classic-menu-in-navigation-block/)

- [Advanced Query Loop](https://wordpress.org/plugins/advanced-query-loop/)
