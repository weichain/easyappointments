<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments Configuration File
 *
 * Set your installation BASE_URL * without the trailing slash * and the database
 * credentials in order to connect to the database. You can enable the DEBUG_MODE
 * while developing the application.
 *
 * Set the default language by changing the LANGUAGE constant. For a full list of
 * available languages look at the /application/config/config.php file.
 *
 * IMPORTANT:
 * If you are updating from version 1.0 you will have to create a new "config.php"
 * file because the old "configuration.php" is not used anymore.
 */
class Config {

    // ------------------------------------------------------------------------
    // GENERAL SETTINGS
    // ------------------------------------------------------------------------

    public static $BASE_URL      = '';
    public static $LANGUAGE      = '';
    public static $DEBUG_MODE    = '';

    // ------------------------------------------------------------------------
    // DATABASE SETTINGS
    // ------------------------------------------------------------------------

    public static $DB_HOST       = '';
    public static $DB_NAME       = '';
    public static $DB_USERNAME   = '';
    public static $DB_PASSWORD   = '';

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

    public static $GOOGLE_SYNC_FEATURE   = '';
    public static $GOOGLE_PRODUCT_NAME   = '';
    public static $GOOGLE_CLIENT_ID      = '';
    public static $GOOGLE_CLIENT_SECRET  = '';
    public static $GOOGLE_API_KEY        = '';

    // Initialize configuration with environment variables
    public static function init() {
        self::$BASE_URL = getenv('BASE_URL');
        self::$LANGUAGE = getenv('LANGUAGE');
        self::$DEBUG_MODE = filter_var(getenv('DEBUG_MODE'), FILTER_VALIDATE_BOOLEAN);

        self::$DB_HOST = getenv('DB_HOST');
        self::$DB_NAME = getenv('DB_NAME');
        self::$DB_USERNAME = getenv('DB_USERNAME');
        self::$DB_PASSWORD = getenv('DB_PASSWORD');

        self::$GOOGLE_SYNC_FEATURE = filter_var(getenv('GOOGLE_SYNC_FEATURE'), FILTER_VALIDATE_BOOLEAN);
        self::$GOOGLE_PRODUCT_NAME = getenv('GOOGLE_PRODUCT_NAME');
        self::$GOOGLE_CLIENT_ID = getenv('GOOGLE_CLIENT_ID');
        self::$GOOGLE_CLIENT_SECRET = getenv('GOOGLE_CLIENT_SECRET');
        self::$GOOGLE_API_KEY = getenv('GOOGLE_API_KEY');
    }
}

// Initialize configuration
Config::init();

/* End of file config.php */
/* Location: ./config.php */
