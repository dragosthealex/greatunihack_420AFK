<?php
require_once '../../inc/init.php';

if(!isset($_POST['registerEmail'], $_POST['registerPassword'], $_POST['registerConfirmPassword'], $_POST['registerUsername'], $_POST['registerFirstName'], $_POST['registerLastName']))
{
  include __ROOT__.'/inc/templates/notfound.php';
  exit();
}
try
{
  $params['email'] = htmlentities($_POST['registerEmail']);
  $params['password'] = htmlentities($_POST['registerPassword']);
  $confPass = htmlentities($_POST['registerConfirmPassword']);
  $params['username'] = htmlentities($_POST['registerUsername']);
  $params['firstName'] = htmlentities($_POST['registerFirstName']);
  $params['lastName'] = htmlentities($_POST['registerLastName']);
  $params['salt'] = hash('sha256', mt_rand());

  if($params['password'] != $confPass)
  {
    throw new Exception("Confirmation passoword does not match", 1);
  }

  $params['password'] = hash('sha256', $params['salt'] . $params['password']);

  $user = new CurrentUser($con, 'insert', $params);
  if($user->getError())
  {
    throw new Exception("Error registering: " . $user->getError(), 1);
  }
  $success = $user->logIn($params['password']);
  if($success)
  {
    header('Location: ../');
    exit();
  }
  else
  {
    throw new Exception("Error with user. Possibly fucked shit up.", 1);
  }
}
catch(Exception $e)
{
  header('Location: ../?err=' . $e->getMessage());
  exit();
}



?>