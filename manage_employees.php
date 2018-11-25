<?php

require_once("config/db.php");
require_once("classes/ManageEmployees.php");

$manageEmployees = new ManageEmployees();

include("views/menu.php");
include("views/manage_employees.php");