<?php
/**
 * Created by Latendresse Antoine && Yannick Delaire.
 * Date: 11/16/15
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = array();
session_destroy();
unset( $_SESSION );
header("Location: ../Views/login.php");