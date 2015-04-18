<?php
require_once 'Base.php';
class UserRole extends Base
{
  private $userId;
  private $role;
  private $contentId;
  private $contentType;

  /* if action == 'get'
  $params[id]
  if action == 'insert'
  $params[userId], $params[role], $params[contentType], $params[contentId]
  */
  public function __construct($con, $action, $params)
  {
    try
    {
      if(!isset($con) || !$con)
      {
        throw new Exception("Problem with db connection handler", 1);
      }
      if($action == 'get')
      {
        $id = isset($params['id'])?$params['id']:'';
        $stmt = $con->prepare("SELECT * FROM user_roles WHERE id='$id'");
        if(!$stmt->execute())
        {
          throw new Exception("Error getting user from db", 1);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->userId = isset($result['userId'])?$result['userId']:'';
        $this->role = isset($result['role'])?$result['role']:'';
        $this->contentType = isset($result['contentType'])?$result['contentType']:'';
        $this->contentId = isset($result['contentId'])?$result['contentId']:'';
        $this->con = $con;
        $this->id = $id;
      }// if
      else if($action == 'insert')
      {
        $userId = isset($params['userId'])?htmlentities($params['userId']):'';
        $contentType = isset($params['contentType'])?htmlentities($params['contentType']):'';
        $role = isset($params['role'])?htmlentities($params['role']):'';
        $contentId = isset($params['contentId'])?htmlentities($params['contentId']):'';

        $stmt = $con->prepare("INSERT INTO user_roles (userId, role, contentId, contentType) VALUES ('$userId', '$role', '$contentId', '$contentType')");
        if(!$stmt->execute())
        {
          throw new Exception("Error inserting role for $userId", 1);
        }
        $id = $con->lastInsertId();

        $this->id = $id;
        $this->userId = $userId;
        $this->role = $role;
        $this->contentType = $contentType;
        $this->contentId = $contentId;
        $this->con = $con;
      }
    }// try
  }

}


?>