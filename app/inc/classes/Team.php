<?php
require_once 'Base.php';
class Team extends Base
{
  private $name;
  private $projectName;
  private $eventId;

  /* When action == get
  params[id]
  When action == insert
  params[name], params[eventId]
  */
  public function __construct($con, $action, $params) 
  {
    try
    {
      if(!isset($con) || !$con)
      {
        throw new Exception("Problem with connection handler", 1);
      }
      if($action == 'get')
      {
        $id = isset($params['id'])?$params['id']:'';
        $stmt = $con->prepare("SELECT * FROM teams WHERE id='$id'");
        if(!$stmt->execute())
        {
          throw new Exception("Error getting team $id from db", 1);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $id;
        $this->con = $con;
        $this->name = isset($result['name'])?$result['name']:'';
        $this->projectName = isset($result['projectName'])?$result['projectName']:'';
        $this->eventId = isset($result['eventId'])?$result['eventId']:'';
      }// if
      else if($action == 'insert')
      {
        $name = isset($params['name'])?$params['name']:'';
        $eventId = isset($params['name'])?$params['eventId']:'';
        $stmt = $con->prepare("INSERT INTO teams (name, projectName) VALUEs ('$name', '$projectName')");
        if(!$stmt->execute())
        {
          throw new Exception("Error inserting team $name into db", 1);
        }
      }
    }//try
    catch (Exception $e)
    {
      $this->errorMsg = $e->getMessage();
    }
  }// function __construct  


}//class 



?>