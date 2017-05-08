<?
error_reporting(-1);
ini_set('display_errors', 'On');

session_start();

include_once "main.php";

$GLOBALS['main'] = new MainController();

$GLOBALS['main']->call_view($_GET['u']);

?>