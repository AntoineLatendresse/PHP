<?php
/**
 * Created by PhpStorm.
 * User: 201087112
 * Date: 2015-11-23
 * Time: 15:35
 */
session_start();

define("VIEW_INDEX", "../Views/index.php");

session_destroy();
unset( $_SESSION );

header('Location: ' . VIEW_INDEX);
