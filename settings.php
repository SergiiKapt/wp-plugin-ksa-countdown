<?php

require_once KSA_COUNTD_P_DIR . '/includes/posttype.php';
require_once KSA_COUNTD_P_DIR . '/includes/functions.php';
require_once KSA_COUNTD_P_DIR . '/includes/scripts.php';

if (is_admin()) {
    require_once KSA_COUNTD_P_DIR . '/admin/admin.php';
}