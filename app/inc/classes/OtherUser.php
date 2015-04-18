<?php
require_once 'GeneralUser.php';
class OtherUser extends GeneralUser
{
  const TYPE = 1;
  // constructor
  public function __construct($con, $key)
  {
    $key = htmlentities($key);
    $stmt = $con->prepare("SELECT * FROM users WHERE id='$key' OR username='$key' OR email='$key'");
    try
    {
      if(!$stmt->execute())
      {
        throw new Exception("Error getting user $key from db.", 1);
      }
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->credentials['username'] = isset($result['username'])?$result['username']:'';
      $this->credentials['firstName'] = isset($result['firstName'])?$result['firstName']:'';
      $this->credentials['lastName'] = isset($result['lastName'])?$result['lastName']:'';
      $this->credentials['email'] = isset($result['email'])?$result['email']:'';
      $this->id = isset($result['id'])?$result['id']:'';
      $this->con = $con;
      $stmt = null;
    }
  }// function __construct


}// class OtherUser