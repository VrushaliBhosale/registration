<?php
require_once "vendor/autoload.php";
session_start();
if($_SESSION['admin'])
{
include_once "registration.php";
?>


<?php
}
?>