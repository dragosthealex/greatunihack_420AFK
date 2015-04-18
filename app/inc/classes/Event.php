<?php
require_once 'Base.php';
class Event extends Base
{
  private $platformId;
  private $startDateTime;
  private $endDateTime;
  private $location;
  private $name;

  /* if action == 'get'
  params[id]
  if action == 'insert'
  params[platformId]
  params[startDateTime]
  params[endDateTime]
  params[location]
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
        $stmt = $con->prepare("SELECT * FROM events WHERE id='$id'");
        if(!$stmt->execute())
        {
          throw new Exception("Error getting event $id from db", 1);
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // set vars
        $this->platformId = isset($result['platformId'])?$result['platformId']:'';
        $this->startDateTime = isset($result['startDateTime'])?$result['startDateTime']:'';
        $this->endDateTime = isset($result['endDateTime'])?$result['endDateTime']:'';
        $this->location = isset($result['location'])?$result['location']:'';
        $this->name = isset($result['name'])?$result['name']:'';
        $this->con = $con;
        $this->id = $id;
      }
      else if($action == 'insert')
      {
        // validate
        $platformId = isset($params['platformId'])?htmlentities($params['platformId']):'';
        $startDateTime = isset($params['startDateTime'])?htmlentities($params['startDateTime']):'';
        $endDateTime = isset($params['endDateTime'])?htmlentities($params['endDateTime']):'';
        $location = isset($params['location'])?htmlentities($params['location']):'';
        $name = isset($params['name'])?htmlentities($params['location']);
        // insert
        $stmt = $con->prepare("INSERT INTO events (platformId, startDateTime, endDateTime, location, name) VALUES ('$platformId', '$startDateTime', '$endDateTime', '$location', '$name')");
        if(!$stmt->execute())
        {
          throw new Exception("Error inserting event into db", 1);
        }

        $this->platformId = $platformId;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
        $this->location = $location;
        $this->name = $name;
        $this->id = $id;
        $this->con = $con;
      }
    }// try
    catch (Exception $e)
    {
      $this->errorMsg = $e->getMsg();
    }
  }// function __construct
}// class Event