<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'staging_eknowledge' );

/** Database username */
define( 'DB_USER', 'ashabil' );

/** Database password */
define( 'DB_PASSWORD', 'taharica2024' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'k9dOpx1x8|>K%%$KmYq3,-o G!x~%A0Rz^A;N%606.7_yh+2|1o|nu]>O+4,BsF2' );
define( 'SECURE_AUTH_KEY',  'Ik<s)TWJa?05/BTsD?6R`Dnt{>jf4JW1d0Yy*53wl6O;]#P-$_0H &:b5;({cgJr' );
define( 'LOGGED_IN_KEY',    'bjUxsjk}aLa-a??(/sUOhzO+3aD$+~cba>tCanQ`+?}+1yKk/EKkjoIdOKUPmzGe' );
define( 'NONCE_KEY',        'SrKo4x}=8HVzAy$I)N&FTtlQ{qGs}fas5^)pu9ZUEIjJszmPO)6e`EEFY/}Afg3}' );
define( 'AUTH_SALT',        'oP]P32PFz+!fTyLo,OtlrdO-b[@qT;U_hn{d3SV!.u^8#aNcEZspR*SX(;<eW+9-' );
define( 'SECURE_AUTH_SALT', 'h!k!ZZ=ReR<MoV=Ho]{Zcc@92)r.A9!x@8kc8g~PKdFtvTs?MjCAY}tMkA>%{:Pn' );
define( 'LOGGED_IN_SALT',   'u!!+:X1iBr^=jTz;/SH vmwCH5U(<?#+2L<ZllVUg2NjcN5tw[$,mR?7M7Gc$SP)' );
define( 'NONCE_SALT',       ':`H%9v7#;by.,9S );[x<v!5DX[ wr6.XC=_)Har]?/a(F`4},0W~* = `x&|=#r' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );



/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
