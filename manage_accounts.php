<?php

require_once("config/db.php");
require_once("classes/ManageAccounts.php");

$manageAccounts = new ManageAccounts();

include("views/menu.php");
include("views/manage_accounts.php");