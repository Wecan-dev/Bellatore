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
define( 'DB_NAME', 'bellatore' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

define('FS_METHOD', 'direct');

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         'T==myExWn.,_)v_LIQZo_/J)xS,j ?i2ZGM>-5_SwKK9 nEQLqPXCyd`3W7F ^|K' );
define( 'SECURE_AUTH_KEY',  'IOY1id_,e*+RuxM&)x~iR8p[SY[c:r?&zKY=XPDGQpREz55Xd464nONp4rX-4Ji(' );
define( 'LOGGED_IN_KEY',    '?|P0j<2k p/Qg@zz1-?:-%L`fEy*S!3*DC3anL2K;1fr!+rNexZ9;{i`cunti8}b' );
define( 'NONCE_KEY',        '<=S-339B|R=6F{]Irhk0x;>`oB6QM{9ME7nHc][@x^zQvp@f`K>sPz5o;;R(UO^8' );
define( 'AUTH_SALT',        'J@@#KH4Ubu6CYGRcvo(z[%X-NT@8et6Dr>*V)x(gMfWJ:S?Y1gcT+V$apK&]Cajd' );
define( 'SECURE_AUTH_SALT', '>zC&dnG+5Pw/DqtcMoRd*_c;<mSMIa[%1o4P~(Tx]0dLca5F01AScR(GW&?~o->f' );
define( 'LOGGED_IN_SALT',   '3hN.>?K=QZ)8G@Vw6>e7<8Py1_,usCjt/2?G2sTS^@DGT,mTu,R#%Z=`&wg0VyWa' );
define( 'NONCE_SALT',       'sIA[I,LckwWcm8-7jd7>. V.QFrGNwCVv8_+_a,R)}DIk1SMwXE-l@4rYW|Jh6v,' );

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

