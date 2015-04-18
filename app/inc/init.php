<?php
session_start('quizinator');
define('__ROOT__', dirname(dirname(__FILE__)));
define('LOGGED_IN', isset($_SESSION['user']));
// Define whether or not the user has just logged in, for later use.
define("JUST_LOGGED_IN", isset($_SESSION['justLoggedIn']));
if (JUST_LOGGED_IN)
{
  // Don't display next time
  unset($_SESSION['justLoggedIn']);
} // if

$ioStatus = LOGGED_IN ? 'in' : 'out';
function __autoload($class) {
  include_once __ROOT__.'/inc/classes/'.$class.'.php';
}
$webRoot = isset($rootDirectory) ? "." : "..";

require_once __ROOT__.'/db_settings.php';
// Connection to the db. Catch any error.
// $con is the connection handler, PDO object.
try
{
  $con = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
} catch (PDOException $e)
{
  // Exit the script if the database conneciton fails.
  exit('Connection failed: ' . $e->getMessage());
}

if(LOGGED_IN)
{
  $user = new CurrentUser($con, 'get', array('key'=>$_SESSION['user']['id']));
}

?>