<?php
require_once 'GeneralUser.php';
class CurrentUser extends GeneralUser
{
  public function __construct($con, $action, $params)
  {
    try
    {
      if($action == 'insert')
      {
        $username = isset($params['username'])?$params['username']:'';
        $password = isset($params['password'])?$params['password']:'';
        $salt = isset($params['salt'])?$params['salt']:'';
        $firstName = isset($params['firstName'])?$params['firstName']:'';
        $lastName = isset($params['lastName'])?$params['lastName']:'';
        $email = isset($params['email'])?$params['email']:'';
        $date = date('Y-m-d');

        $stmt = $con->prepare("INSERT INTO users (username, email, firstName, lastName, password, salt, registerDate) VALUES ('$username', '$email', '$firstName', '$lastName', '$password', '$salt', '$date')");

        if(!$stmt->execute())
        {
          throw new Exception("Error inserting new user in db", 1);
        }
        $id = $con->lastInsertId();

        $this->credentials['username'] = $username;
        $this->credentials['firstName'] = $firstName;
        $this->credentials['lastName'] = $lastName;
        $this->credentials['id'] = $id;
        $this->credentials['password'] = $password;
        $this->credentials['salt'] = $salt;
        $this->credentials['date'] = $date;
        $this->con = $con;
      }
      else if($action == 'get')
      {
        $key = isset($params['key'])?$params['key']:'';
        $stmt = $con->prepare("SELECT * FROM users WHERE id='$key' OR username='$key' OR email='$key'");
        if(!$stmt->execute())
        {
          throw new Exception("Error geting user from db", 1);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->credentials = $result;
        $this->id = $result['id'];
        $this->con = $con;
      }
    }// try
    catch(Exception $e)
    {
      $this->errorMsg = "Problem initialising user: " . $e->getMessage();
    }
  }// construct

  public function logIn($password)
  {
    if(hash('sha256', $this->credentials['salt'] . $password) == $this->credentials['password'])
    {
      $_SESSION['user']['id'] = $this->id;
      $_SESSION['user']['username'] = $this->username;
      $_SESSION['user']['email'] = $this->email;
      return 1;
    }
    else
    {
      return 0;
    }
  }
}



?>