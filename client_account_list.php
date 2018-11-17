<?php
session_start();

$connect = mysqli_connect("localhost", "root","","testAccount");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}