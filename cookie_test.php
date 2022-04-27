<?php
# Cookies can store values in the users browser
# You can't expect that users will have cookies enabled
# Create a cookie with name, value, expiration date (1 day)
# and make available to your entire site
# You modify cookie vales by running setcookie again
# Delete a cookie by setting the expiration in the past
# setcookie("my_cookie", "", time() - 86400, "/");
setcookie("my_cookie", "sample value", time() + 86400, "/");
 ?>
 <!DOCTYPE HTML>
 <html lang="en">
 <body>
   <?php
   # Check if cookie is set
    if(!isset($_COOKIE["my_cookie"])){
      echo "Cookie Not Set<br>";
    } else {
      # Output cookie value
      echo "Cookie Value : " . $_COOKIE["my_cookie"] . "<br>";
    }
    ?>
  </body>
  </html>