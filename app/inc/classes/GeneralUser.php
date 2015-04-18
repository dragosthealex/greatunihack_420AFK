<?php
require_once 'Base.php';
abstract class GeneralUser extends Base
{
  protected $credentials;

  public function getCredential($key)
  {
    if(isset($credentials[$key]))
    {
      return $credentials[$key];
    }
    else
    {
      $this->errorMsg = "No credential with this key";
      return 0;
    }
  }// function

  

}



?>