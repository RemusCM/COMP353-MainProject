<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

require_once("classes/Login.php");
require_once("classes/ClientNotified.php");
require_once("classes/AccountMoneyTransfer.php");
require_once("classes/InteracTransfer.php");
require_once ("classes/Reports.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in.

    include("views/menu.php");
    include("views/home_page.php");

    if (!$login->isUserAdmin()) {
        $clientNotified = new ClientNotified();
        $clientMoneyTransfer = new AccountMoneyTransfer();
        $clientInteracTransfer = new InteracTransfer();
        include("views/list_accounts.php");
    } else {
        $reports = new Reports();
        include("views/reports.php");
    }

} else {
    // the user is not logged in.
    include("views/login_page.php");
}
