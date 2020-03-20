<?php
/**
* The base configuration for WordPress
*
* The wp-config.php creation script uses this file during the
* installation. You don't have to use the web site, you can
* copy this file to "wp-config.php" and fill in the values.
*
* This file contains the following configurations:
*
* * MySQL settings
* * Secret keys
* * Database table prefix
* * ABSPATH
*
* @link https://codex.wordpress.org/Editing_wp-config.php
*
* @package WordPress
*/

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'rollo_netua20');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*
* @since 2.6.0
*/
define('AUTH_KEY', 'uBdFjtdVvn9MsB9GPHwDWXlnA++Ha4Ec1JzwKt5YzpF/1Nq5BLs2659nYNTMiqsu');
define('SECURE_AUTH_KEY', 'BBO55bASVOR1ciRV9Rfj4iSy70m3WevpLbz5GGzuAOezg9A5K6OboxteLf48uhD6');
define('LOGGED_IN_KEY', 'eJJshNoIZMkudp7a3QBRhEsIzVqL9A6fseyKXBEm9pg96wyeTZfNf+Wrh9FzD7Du');
define('NONCE_KEY', 'bO/qQ5M/tKCCl1NCYe+5SWUl6tYzDv6b7B7MXg5hafU/nbnls6s1YBilWE6uQMD3');
define('AUTH_SALT', 'LGJbP4U7oAcSP+RTfnEiN7IGivAoelR3N8n8MiafcP2wp2p9MfxinyiOk2Zg3a4D');
define('SECURE_AUTH_SALT', 'RlugU/dhOG1YwdpBOH2sH4Mm1zcSyBTGZeEg0d/zSxY+d2LISJjftqlbA4vqzSyt');
define('LOGGED_IN_SALT', 'TEiKoS9/9t3zLJWWK52VqTM4tJ1npa4USFS87y82UE0BaMncYD69gyxos19gnjC1');
define('NONCE_SALT', 'grtmeuyVI6JlL+XQXrgNAhWphYGJSSzYG5n+1cEai40RSC9WNPVypMsp7f5B9qMZ');

/**#@-*/

/**
* WordPress Database Table prefix.
*
* You can have multiple installations in one database if you give each
* a unique prefix. Only numbers, letters, and underscores please!
*/
$table_prefix = 'wp_';

/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*
* For information on other constants that can be used for debugging,
* visit the Codex.
*
* @link https://codex.wordpress.org/Debugging_in_WordPress
*/
define( 'WP_DEBUG', false );

define( 'WP_HOME', 'http://rollo.me' );
define( 'WP_SITEURL', 'http://rollo.me' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
