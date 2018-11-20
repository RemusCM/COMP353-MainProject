<?php

require_once("config/db.php");
require_once("classes/ManageClients.php");

$manageClients = new ManageClients();

include("views/view_clients.php");