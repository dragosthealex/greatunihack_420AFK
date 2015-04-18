<?php
/*
To do:
1 Output footer content
(2 Close body/html)
For the sake of layout, let the body/html be closed on every page
*/
?>
<!-- Footer -->

<div class="box">
  <ul class="box-padding footer">
    <li class="footer-item">Quzinator &copy; 2015</li>
    <li class="footer-item"><a href="<?=$webRoot?>/about" class="footer-link">About</a></li>
    <li class="footer-item"><a href="<?=$webRoot?>/terms" class="footer-link">Terms</a></li>
    <li class="footer-item"><a href="<?=$webRoot?>/privacy" class="footer-link">Privacy</a></li>
    <li class="footer-item"><a href="<?=$webRoot?>/privacy#Use_of_Cookies" class="footer-link">Cookies</a></li>
    <li class="footer-item"><a href="<?=$webRoot?>/disclaimer" class="footer-link">Disclaimer</a></li>
  </ul>
</div>

<!--closing main-->
</div>

<!-- Scripts -->
<?php
  // Output the global scripts
  echo "<script src='$webRoot/media/js/global.js'></script>";
  // If there are other scripts to output, output those too
  if (isset($scripts))
  {
    foreach ($scripts as $script)
    {
      echo "<script src='$webRoot/media/js/$script.js'></script>";
    }
  }
?>
</body>
</html>
