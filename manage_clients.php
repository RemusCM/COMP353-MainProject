<?php

require_once("config/db.php");
require_once("classes/ManageClients.php");

$manageClients = new ManageClients();

include("views/menu.php");
include("views/manage_clients.php");