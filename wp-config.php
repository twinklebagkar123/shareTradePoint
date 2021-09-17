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
define( 'DB_NAME', 'i7490950_wp6' );

/** MySQL database username */
define( 'DB_USER', 'i7490950_wp6' );

/** MySQL database password */
define( 'DB_PASSWORD', 'T.QDcLTXMTgaJvykZMx90' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         'hXyFQE6YP31ZEPv8b1bqAPpONl9Qb9EfXOyvH8u2Q9zFfPATSq36FegvrXfgZI0K');
define('SECURE_AUTH_KEY',  'MzYZYJCZEihCSgTuWD0gop4pduMm1EyAphoJLmzjslnWcwZuIw6cUaLoiRYIg57M');
define('LOGGED_IN_KEY',    'iqnxofnyaTgVOYsa7Ctnp4vJZpjxG5jrPi87Nj8VbGGpltbPW32FRxXBBDzuknAs');
define('NONCE_KEY',        'Es7uksxvYPwhTsssK61XkDO4NZG6VaO6k1Ey2nMWW3FhxgrzwDiJ7HVj7kwGvVy4');
define('AUTH_SALT',        'uzQHqlFlspudc6c4KKDcviY7u52ZJBPFJIkgnvnKPkFPkfJUA1zMRlHSSJIezFyu');
define('SECURE_AUTH_SALT', 'tDfEioB4ocA3YZ3Z7RVB95Vh9Os0OwwDaT6H9cK4zCQPjRrEtjOzIcRoByYhBYtg');
define('LOGGED_IN_SALT',   'RIOb3bquVJcUifjZ9i7oQ4UlQGa16tmvc31kfVHDMO1zu97TaWDmZEVfsDLt7aA8');
define('NONCE_SALT',       'V1HC9E8A483OdJxatJLSYC0iAeafJyWbJjt2qoFy4Qx0KYgMWHUEYo3Im77Xl0GA');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0755);
define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed externally by Installatron.
 * If you remove this define() to re-enable WordPress's automatic background updating
 * then it's advised to disable auto-updating in Installatron.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


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
