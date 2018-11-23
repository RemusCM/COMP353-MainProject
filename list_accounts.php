<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-22
 * Time: 17:22
 */
require_once("config/db.php");
require_once("classes/ClientNotified.php");
$clientNotified = new ClientNotified();
include("views/menu.php");
include("views/list_accounts.php");