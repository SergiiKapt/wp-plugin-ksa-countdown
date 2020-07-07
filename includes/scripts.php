<?php
add_action('admin_init', 'ksa_countd_script_admin');
function ksa_countd_script_admin()
{
    wp_enqueue_style('ksa-countdown-style', KSA_COUNTD_P_URI . 'assets/css/style.css');

    wp_enqueue_script('ksa-countdown-script', KSA_COUNTD_P_URI . 'assets/js/admin.js', array('jquery'), null,true);
}

add_action('wp_enqueue_scripts', 'ksa_countd_script_front');
function ksa_countd_script_front()
{
    wp_enqueue_script('animateNumber-js', KSA_COUNTD_P_URI . 'assets/js/jquery.animateNumber.min.js',  array('jquery'), null, true);
    wp_enqueue_script('itdecision-js', KSA_COUNTD_P_URI . 'assets/js/script.js' , array('jquery', 'animateNumber-js'), null, true);
}