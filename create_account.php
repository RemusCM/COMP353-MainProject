<?php

require_once("config/db.php");
require_once("classes/AccountCreated.php");

$accountCreated = new AccountCreated();

include("views/menu.php");
include("views/create_account.php");