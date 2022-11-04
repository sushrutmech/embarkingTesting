<?php
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '}a=}_jW+EvK|:^t}Kgc4^L_PXLdq>(]0u}O5z&$]Pye64<Sp1$I+&KoCq4L5/3oC' );
define( 'SECURE_AUTH_KEY',  'la0c;dele0FVN (ftR_n5Q8{hYJxirHaVT&2U^trDs3fT(*]jl+&4{]vXj:/;Kht' );
define( 'LOGGED_IN_KEY',    'DUviX`9y9_GOs6+sQFAVSG6Gf[v,Wz8lDeia *i}d6Cm5b-,]ULKsfH|.6W-{2)F' );
define( 'NONCE_KEY',        '*P[qsj#N[[9k]; %]i6ly4`xzy?_.**a|c~e_5-y6%N=0B-uPlo}s q;@4pe;GY&' );
define( 'AUTH_SALT',        '0+W*J#LMIAlr[Ir-quGmScixM80K>a$-PV9?Wh6c9w~oXY PZhyGEz`3&8Vh+_ei' );
define( 'SECURE_AUTH_SALT', 't5<~_!O$44-Y6^l7XFLUTR0?vM5J=2G_1n=dOl&utF/^A]i>3+1H{7b8`8;W1&-=' );
define( 'LOGGED_IN_SALT',   'A-x-/`~*!!fK3qTS[=]4c$y-!s38mgt.?1~kwf[W8!$>~SYK&a],o:)9}?ks,)yb' );
define( 'NONCE_SALT',       'LKPtWLLWkQ(,jKJ%_huk!xx;nmUp*wT fJIX!!8dm4k40U9Yjpb| gRs0$um,7[#' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
