<?php

class Config {
    const BASE_URL = '';
    const DATABASE_HOST = '';
    const DATABASE_USER = '';
    const DATABASE_PASS = '';
    const DATABASE_NAME = '';
    const DEBUG_MODE = '';

    public static function loadEnvVars() {
        self::setConstant('BASE_URL', getenv('BASE_URL'));
        self::setConstant('DATABASE_HOST', getenv('DATABASE_HOST'));
        self::setConstant('DATABASE_USER', getenv('DATABASE_USER'));
        self::setConstant('DATABASE_PASS', getenv('DATABASE_PASS'));
        self::setConstant('DATABASE_NAME', getenv('DATABASE_NAME'));
        self::setConstant('DEBUG_MODE', getenv('DEBUG_MODE'));
    }

    private static function setConstant($name, $value) {
        $constantName = 'self::' . $name;
        if (!defined($constantName)) {
            define($constantName, $value);
        }
    }
}

Config::loadEnvVars();
