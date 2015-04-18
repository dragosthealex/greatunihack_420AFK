<?php
$err = '';
if(isset($_GET['err']))
{
  switch ($_GET['err']) 
  {
    case 'incorrect':
      $err = 'Your password was incorrect';
      break;
    
    default:
      $err = $_GET['err'];
      break;
  }
?>
<div class="box">
  <div class="box-padding">
    <p class="text error"><?=$err?></p>
  </div>
</div>

<?php
}
?>