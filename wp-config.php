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
define( 'DB_NAME', 'rollo_dev2020' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'YBpYP6{xQf-O,llF;NRw7#R#%FG2T^xn:ymS;0FZ`rh9%O4x|BV(~x54rBf{S@.`' );
define( 'SECURE_AUTH_KEY',  '4wa,9]:cQCf&&%}0Cxq#v8MUxtjKy0lbx?q)pg>X[:CYqs!l[:uj~<ySb&9bJD[}' );
define( 'LOGGED_IN_KEY',    'bh|?/x{{AH|b%!n@45i?I9vq{Te>oVg::DZ.meSJVkF^/oMoeC|x3j5bz#qh*^,V' );
define( 'NONCE_KEY',        '<*#1F,M)xcgmF G7PoVYYEJ$D.Zt4N/mX#-bqXz&(FofM<dY`%)(>n-z W(u~ae[' );
define( 'AUTH_SALT',        'R$q#{su#}LJ{28<*j]Fw+W &4NJ/]zh>OA*jYh/W2fhee[NZTH(z:;{`KnDL.fCa' );
define( 'SECURE_AUTH_SALT', 'HcjK u]3<2A%9qy3$KDWQwsX~$?Z(Elga$HXf{SDfJAOalf9u5_ht}_I%/FBINs1' );
define( 'LOGGED_IN_SALT',   '%,+I@;JR%LYgl_%^^O~V9ho!4L$PY.Sv+T9kzjXm5$~C3,&bkgC|n>~jKuk(s+x;' );
define( 'NONCE_SALT',       'Y.BK9X] *h?g.Pz7jTD=R/Di9lI(uG4A4J#Y&},&CeE)<JA3@]7%8,<z*)DlBNyN' );

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
