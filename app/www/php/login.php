<?php
require_once '../../inc/init.php';

if(!isset($_POST['login'], $_POST['password'], $_POST['submit']))
{
  include __ROOT__.'/inc/templates/notfound.php';
  exit();
}
try
{
  $login = htmlentities($_POST['login']);
  $password = htmlentities($_POST['password']);

  $user = new CurrentUser($con, 'get', array('key'=>$login));
  $success = $user->logIn($password);
  if($user->getError())
  {
    throw new Exception("Error with logging in: " . $user->getError(), 1);
  }
  if($success)
  {
    header('Location: ../');
    exit();
  }
  else
  {
    header('Location: ../?err=incorrect');
    exit();
  }
}
catch(Exception $e)
{
  header('Location: ../?err=' . $e->getMessage());
  exit();
}
?>