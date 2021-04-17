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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/srv/disk6/2594363/www/kamocstore.onlinewebshop.net/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', '2594363_wpress5e480cfe' );

/** MySQL database username */
define( 'DB_USER', '2594363_wpress5e480cfe' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ij5wVgZ2IsaYlRv8bmqK0R8A822zoofc' );

/** MySQL hostname */
define( 'DB_HOST', 'pdb35.runhosting.com' );

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
define( 'AUTH_KEY',         '2:GBb&S<hrFvm=GkQ1aM6dVT>LPH1I>QP0G2%jQYqqkc*4&M_jj50#]@L7faaHq(' );
define( 'SECURE_AUTH_KEY',  'j*PkMQNS+zH4Z61:C855MsFM;T)/s1;wbB9ZtQ]LRj9{n0:F$AsdW_Z/gxvq]`p-' );
define( 'LOGGED_IN_KEY',    '-<+]$-aP&j1%UH fLf)8/da5+tyd I,zak5~Q*v=[M>vBNd.gJ8=rpRQ0&ebHk8b' );
define( 'NONCE_KEY',        '=sA{8t=Dex)*Z`^GilX;v0D*mkqslB %/E-O.BJqI0PpS!;bp5=OAt~lF=bDfzts' );
define( 'AUTH_SALT',        'ZB05P*9N+SEh}%F [3fU,sgGE{<nb+StK>~Jvq>{f/+7_z: zvzrz-^KP&5;,0|:' );
define( 'SECURE_AUTH_SALT', ';^>Vi>N^^Qf?j_gu}n_HR-Ez#[XrAM!@orBSB;YL99mu92S5?[<B@1.dxO[itqVy' );
define( 'LOGGED_IN_SALT',   '`#44.#.b-lk<<>@ S~W?BY#NMf/Ni7G-P)+XLjTV5p$2>:0(#*DwU1YQA2.bqN]V' );
define( 'NONCE_SALT',       'KA [b2DtPXxQp2yQ!!Y>/|ojgTmC{2]0B5AO&&y]vzMe[sj637j]Z%wL;&Q(TS,g' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
