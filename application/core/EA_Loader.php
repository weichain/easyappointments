<?php defined('BASEPATH') or exit('No direct script access allowed');

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2020, Alex Tselegidis
 * @license     https://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        https://easyappointments.org
 * @since       v1.4.0
 * ---------------------------------------------------------------------------- */

/**
 * Easy!Appointments loader.
 *
 * @property EA_Benchmark $benchmark
 * @property EA_Cache $cache
 * @property EA_Calendar $calendar
 * @property EA_Config $config
 * @property EA_DB_forge $dbforge
 * @property EA_DB_query_builder $db
 * @property EA_DB_utility $dbutil
 * @property EA_Email $email
 * @property EA_Encrypt $encrypt
 * @property EA_Encryption $encryption
 * @property EA_Exceptions $exceptions
 * @property EA_Hooks $hooks
 * @property EA_Input $input
 * @property EA_Lang $lang
 * @property EA_Loader $load
 * @property EA_Log $log
 * @property EA_Migration $migration
 * @property EA_Output $output
 * @property EA_Profiler $profiler
 * @property EA_Router $router
 * @property EA_Security $security
 * @property EA_Session $session
 * @property EA_Upload $upload
 * @property EA_URI $uri
 */
class EA_Loader extends CI_Loader {
    /**
     * Loads "layout" files.
     *
     * @param string $layout Path to the layout view file.
     * @param string $page Path to the page view file.
     * @param array $vars An associative array of data to be extracted for use in the view
     * @param bool $return Whether to return the view output or leave it to the Output class
     *
     * @return object|string
     *
     * remove this
     */
    public function layout(string $layout, string $page, array $vars = [], bool $return = FALSE)
    {
        $vars['page_path'] = APPPATH . 'views/' . $page . '.php';

        $vars['styles'] = $vars['styles'] ?? [];

        $vars['scripts'] = $vars['scripts'] ?? [];

        $vars['global_variables'] = $vars['global_variables'] ?? [];

        return $this->view($layout, $vars, $return);
    }

    /**
     * Override the original view loader method so that layouts are also supported. 
     * 
     * @param string $view View filename.
     * @param array $vars An associative array of data to be extracted for use in the view.
     * @param bool $return Whether to return the view output or leave it to the Output class.
     * 
     * @return object
     */
    public function view($view, $vars = [], $return = FALSE): object
    {
        $result = $this->_ci_load(['_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return]);

        $layout = config('layout');

        if ($layout)
        {
            $result = $this->_ci_load(['_ci_view' => $layout, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return]);
        }

        return $result;
    }
}