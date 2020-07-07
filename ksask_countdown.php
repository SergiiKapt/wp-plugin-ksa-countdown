<?php
/*
Plugin Name: KSASK Countdown
Plugin URI: https://ksask.net/
Description: Countdown blocks plugin.
Author: Sergii
Author URI: https://ksask.net/
Text Domain: ksask-countdown
Domain Path: /languages/
Version: 1.0
*/
define('KSA_COUNTD', 1);

define('KSA_COUNTD_P', __FILE__);

define('KSA_COUNTD_P_DIR', untrailingslashit(dirname(KSA_COUNTD_P)));

define( 'KSA_COUNTD_P_URI', plugin_dir_url( __FILE__ ) );

require_once KSA_COUNTD_P_DIR . '/settings.php';

register_activation_hook(__FILE__, 'ksa_countd_install');
function ksa_countd_install()
{
    ksa_countd_setup_post_type();
    flush_rewrite_rules();
}

register_deactivation_hook(__FILE__, 'ksa_countd_deactivation');
function ksa_countd_deactivation()
{
    flush_rewrite_rules();
}


