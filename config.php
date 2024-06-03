<?php
/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * author      A.Tselegidis <alextselegidis@gmail.com>
 * copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * link        http://easyappointments.org
 * since       v1.0.0
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

    public static $BASE_URL      = 'https://sea-lion-app-fgzhw.ondigitalocean.app/';
    public static $LANGUAGE      = 'english';
    public static $DEBUG_MODE    = FALSE;

    // ------------------------------------------------------------------------
    // DATABASE SETTINGS
    // ------------------------------------------------------------------------

    public static $DB_HOST       = null;
    public static $DB_NAME       = null;
    public static $DB_USERNAME   = null;
    public static $DB_PASSWORD   = null;

    // ------------------------------------------------------------------------
    // GOOGLE CALENDAR SYNC
    // ------------------------------------------------------------------------

    public static $GOOGLE_SYNC_FEATURE   = FALSE;
    public static $GOOGLE_PRODUCT_NAME   = null;
    public static $GOOGLE_CLIENT_ID      = null;
    public static $GOOGLE_CLIENT_SECRET  = null;
    public static $GOOGLE_API_KEY        = null;

    public static function init() {
        self::$DB_HOST       = getenv('DB_HOST');
        self::$DB_NAME       = getenv('DB_NAME');
        self::$DB_USERNAME   = getenv('DB_USERNAME');
        self::$DB_PASSWORD   = getenv('DB_PASSWORD');
        self::$GOOGLE_SYNC_FEATURE   = getenv('GOOGLE_SYNC_FEATURE') === 'true' ? TRUE : FALSE;
        self::$GOOGLE_PRODUCT_NAME   = getenv('GOOGLE_PRODUCT_NAME');
        self::$GOOGLE_CLIENT_ID      = getenv('GOOGLE_CLIENT_ID');
        self::$GOOGLE_CLIENT_SECRET  = getenv('GOOGLE_CLIENT_SECRET');
        self::$GOOGLE_API_KEY        = getenv('GOOGLE_API_KEY');
    }
}

Config::init();

/* End of file config.php */
/* Location: ./config.php */
