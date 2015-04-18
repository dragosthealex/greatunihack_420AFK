<?php
require_once 'Base.php';
abstract class GeneralUser extends Base
{
  const TYPE = 1;
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