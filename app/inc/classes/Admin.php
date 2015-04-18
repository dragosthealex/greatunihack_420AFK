<?php
include 'GeneralUser.php';
class Admin extends GeneralUser
{
  /* if action == 'get'
  params[key] (id/email/username)
  if action =='insert'
  params[username], params[firstName], params[secondName], params[email], params[password], params[salt], params[registerDate]
  */
  public function __construct($con, $action, $params)
  {
    try
    {
      if(!isset($con) || !$con)
      {
        throw new Exception("Error with connection handler", 1);
      }
      if($action == 'get')
      {
        $id = isset($params['id'])?$params['id']:'';
        // query
        $stmt = $con->prepare("SELECT * FROM admins WHERE id='$key' OR username='$key' OR email='$key'");
        if(!$stmt->execute())
        {
          throw new Exception("Error getting admin $key from db", 1);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // set vars
        $this->platformId = isset($result['platformId'])?$result['platformId']:'';
        $this->firstName = isset($result['firstName'])?$result['firstName']:'';
        $this->lastName = isset($result['lastName'])?$result['lastName']:'';
        $this->password = isset($result['password'])?$result['password']:'';
        $this->salt = isset($result['salt'])?$result['salt']:'';
        $this->con = $con;
        $this->id = isset($result['id'])?$result['id']:'';
        $this->registerDate = isset($result['registerDate'])?$result['registerDate']:'';
        $this->email = isset($result['email'])?$result['email']:'';
        $this->username = isset($result['username'])?$result['username']:'';
      }
      else if($action == 'insert')
      {
        // validate
        $platformId = isset($params['platformId'])?$params['platformId']:'';
        $firstName = isset($params['firstName'])?$params['firstName']:'';
        $lastName = isset($params['lastName'])?$params['lastName']:'';
        $password = isset($params['password'])?$params['password']:'';
        $salt = isset($params['salt'])?$params['salt']:'';
        $con = $con;
        $registerDate = isset($params['registerDate'])?$params['registerDate']:'';
        $email = isset($params['email'])?$params['email']:'';
        $username = isset($params['username'])?$params['username']:'';
        // insert
        $stmt = $con->prepare("INSERT INTO admins (platformId, firstName, lastName, password, salt, id, registerDate, email, username) VALUES ('$platformId', '$firstName', '$lastName', '$password', '$salt', '$id', '$registerDate', '$email', '$username')");
        if(!$stmt->execute())
        {
          throw new Exception("Error inserting event into db", 1);
        }

        $this->platformId = $platformId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->salt = $salt;
        $this->con = $con;
        $this->registerDate = $registerDate;
        $this->email = $email;
        $this->username = $username;
      }
    }// try
    catch (Exception $e)
    {
      $this->errorMsg = $e->getMsg();
    }
  }// function __construct
}


?>